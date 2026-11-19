<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project')
            ->paginate(10);

        return TaskResource::collection($tasks);
    }


  public function store(StoreTaskRequest $request)
{
    $task = Task::create(
        $request->validated()
    );

    TaskCreated::dispatch($task);

    $task->load('project');

    return new TaskResource($task);
}
    


    public function show(Request $request, Task $task)
    {
        $task->load('project');

        if ($request->query('include') === 'comments') {
            $task->load('comments');
        }

        return new TaskResource($task);
    }


    public function update(
        UpdateTaskRequest $request,
        Task $task
    ) {
        $task->update(
            $request->validated()
        );

        $task->load('project');

        return new TaskResource($task);
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}