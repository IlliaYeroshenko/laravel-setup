<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $users = User::factory(3)->create();
        
        foreach ($users as $user) {

            $projects = Project::factory(2)->create([
                'user_id' => $user->id,
            ]);


            foreach ($projects as $project) {


                $statuses = [
                    'new',
                    'in_progress',
                    'done',
                    'new',
                    'in_progress',
                ];


                foreach ($statuses as $status) {

                    $task = Task::factory()->create([
                        'project_id' => $project->id,

                        'author_id' =>
                            $users->random()->id,

                        'assigned_to' =>
                            $users->random()->id,

                        'status' => $status,
                    ]);


                    $commentCount = rand(2, 3);

                    $commentUsers = $users
                        ->shuffle()
                        ->take($commentCount);


                    foreach ($commentUsers as $commentUser) {

                        Comment::factory()->create([
                            'task_id' => $task->id,

                            'user_id' =>
                                $commentUser->id,
                        ]);
                    }
                }
            }
        }
    }
}
