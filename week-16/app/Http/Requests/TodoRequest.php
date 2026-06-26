<?php

namespace App\Http\Requests;

class TodoRequest extends ApiRequest
{
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return true;
        }

        $todo = $this->route('todo');
        return $todo && $todo->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'todo' => 'required|string|max:255',
            'done' => 'sometimes|boolean',
        ];
    }
}
