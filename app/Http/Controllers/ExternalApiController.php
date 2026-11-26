<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalTaskService;

class ExternalApiController extends Controller
{
    private ExternalTaskService $externalTaskService;


    public function __construct(
        ExternalTaskService $externalTaskService
    ) {
        $this->externalTaskService = $externalTaskService;
    }


    public function index()
    {
        $result =
            $this->externalTaskService->getExternalTasks();

        return response()->json(
            $result,
            $result['status']
        );
    }


    public function show($id)
    {
        $result =
            $this->externalTaskService
                ->getExternalTaskById($id);

        return response()->json(
            $result,
            $result['status']
        );
    }


    public function export(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean',
            'userId' => 'required|integer',
        ]);

        $result =
            $this->externalTaskService
                ->sendTaskData($data);

        return response()->json(
            $result,
            $result['status']
        );
    }
}
