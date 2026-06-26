<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $todos = $request->user()->todos;
        return $this->success($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request): JsonResponse
    {
        $todo = $request->user()->todos()->create($request->validated());
        return $this->success($todo, 'Todo created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResponse
    {
        if ($todo->user_id !== auth()->id()) {
            return $this->error('Unauthorized', 403);
        }

        return $this->success($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, Todo $todo): JsonResponse
    {
        $todo->update($request->validated());
        return $this->success($todo, 'Todo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoRequest $request, Todo $todo): JsonResponse
    {
        $todo->delete();
        return $this->success(null, 'Todo deleted successfully');
    }
}
