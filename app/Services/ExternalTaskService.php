<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\ConnectionException;

class ExternalTaskService
{
    private string $baseUrl = 'https://jsonplaceholder.typicode.com';


    public function getExternalTasks(): array
    {
        try {

            $response = Http::timeout(5)
                ->get($this->baseUrl . '/todos');

            if ($response->successful()) {

                Log::info('External tasks received', [
                    'status' => $response->status(),
                ]);

                return [
                    'success' => true,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

            if ($response->failed()) {

                Log::error('Failed to receive external tasks', [
                    'status' => $response->status(),
                ]);

                return [
                    'success' => false,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

        } catch (ConnectionException $e) {

            Log::error('External API connection error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status' => 500,
                'error' => 'Connection error',
            ];
        }

        return [
            'success' => false,
            'status' => 500,
            'error' => 'Unknown error',
        ];
    }


    public function getExternalTaskById($id): array
    {
        try {

            $response = Http::timeout(5)
                ->get($this->baseUrl . '/todos/' . $id);

            if ($response->successful()) {

                Log::info('External task received', [
                    'status' => $response->status(),
                    'task_id' => $id,
                ]);

                return [
                    'success' => true,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

            if ($response->failed()) {

                Log::error('Failed to receive external task', [
                    'status' => $response->status(),
                    'task_id' => $id,
                ]);

                return [
                    'success' => false,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

        } catch (ConnectionException $e) {

            Log::error('External API connection error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status' => 500,
                'error' => 'Connection error',
            ];
        }

        return [
            'success' => false,
            'status' => 500,
            'error' => 'Unknown error',
        ];
    }


    public function sendTaskData(array $data): array
    {
        try {

            $response = Http::timeout(5)
                ->post(
                    $this->baseUrl . '/todos',
                    [
                        'title' => $data['title'],
                        'completed' => $data['completed'],
                        'userId' => $data['userId'],
                    ]
                );

            if ($response->successful()) {

                Log::info('Task sent to external API', [
                    'status' => $response->status(),
                ]);

                return [
                    'success' => true,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

            if ($response->failed()) {

                Log::error('Failed to send task to external API', [
                    'status' => $response->status(),
                ]);

                return [
                    'success' => false,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

        } catch (ConnectionException $e) {

            Log::error('External API connection error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status' => 500,
                'error' => 'Connection error',
            ];
        }

        return [
            'success' => false,
            'status' => 500,
            'error' => 'Unknown error',
        ];
    }
}
