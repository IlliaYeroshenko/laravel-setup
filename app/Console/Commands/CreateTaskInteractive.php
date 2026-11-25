<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Task;
use App\Models\Project;

use App\Events\TaskCreated;

class CreateTaskInteractive extends Command
{
    protected $signature = 'tasks:create-interactive';

    protected $description = 'Інтерактивне створення нового завдання';

    public function handle(): int
    {
        // Отримання даних від користувача
        $title = $this->ask('Назва завдання');

        $description = $this->ask('Опис завдання');

        $projectId = $this->ask('ID проєкту');

        $dueDate = $this->ask(
            'Дедлайн (YYYY-MM-DD)'
        );

        $assignedTo = $this->ask(
            'ID виконавця'
        );

        // Вибір статусу
        $status = $this->choice(
            'Оберіть статус',
            [
                'new',
                'in_progress',
                'done',
            ],
            0
        );

        // Перевірка проєкту
        $project = Project::find($projectId);

        if (!$project) {
            $this->warn(
                'Проєкт з таким ID не знайдено.'
            );

            return self::FAILURE;
        }

        // Підтвердження
        if (!$this->confirm('Зберегти завдання?')) {

            $this->warn(
                'Створення завдання скасовано.'
            );

            return self::SUCCESS;
        }

        // Створення задачі
        $task = Task::create([
            'title' => $title,

            'description' => $description,

            'status' => $status,

            'project_id' => $projectId,

            'author_id' => $project->user_id,

            'assigned_to' =>
                $assignedTo ?: null,

            'due_date' =>
                $dueDate ?: null,
        ]);

        // Генерація події з Lab 9
        TaskCreated::dispatch($task);

        $this->info(
            'Завдання успішно створено. ID: '
            . $task->id
        );

        return self::SUCCESS;
    }
}
