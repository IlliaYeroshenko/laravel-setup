<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',

            'status' => 'required|in:new,in_progress,done',

            'project_id' => 'required|exists:projects,id',

            'author_id' => 'required|exists:users,id',

            'assigned_to' => 'nullable|exists:users,id',

            'due_date' => 'nullable|date',
        ];
    }
}
