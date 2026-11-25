<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class GenerateTaskReport extends Command
{
    protected $signature = 'tasks:report {--project_id=}';

    protected $description = 'Генерація звіту по завданнях';

    public function handle(): int
    {
        $projectId = $this->option('project_id');

        $query = Task::query();

        // Якщо передано ID проєкту - фільтруємо задачі
        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $tasks = $query
            ->orderBy('id')
            ->get();

        // Якщо задач немає
        if ($tasks->isEmpty()) {
            $this->warn('Завдань не знайдено.');

            return self::SUCCESS;
        }

        $this->info('Звіт по завданнях');

        $rows = [];

        foreach ($tasks as $task) {
            $rows[] = [
                $task->id,
                $task->title,
                $task->status,
                $task->due_date ?? '-',
            ];
        }

        $this->table(
            [
                'ID',
                'Назва',
                'Статус',
                'Дедлайн',
            ],
            $rows
        );

        return self::SUCCESS;
    }
}
