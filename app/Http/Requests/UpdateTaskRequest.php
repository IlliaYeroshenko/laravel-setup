<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string',

            'description' => 'nullable|string',

            'status' => 'sometimes|required|in:new,in_progress,done',

            'project_id' => 'sometimes|required|exists:projects,id',

            'author_id' => 'sometimes|required|exists:users,id',

            'assigned_to' => 'nullable|exists:users,id',

            'due_date' => 'nullable|date',
        ];
    }
}
