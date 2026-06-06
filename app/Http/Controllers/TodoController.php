<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::query()
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'data' => $todos,
        ]);
    }

    public function show(Todo $todo): JsonResponse
    {
        return response()->json([
            'data' => $todo,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:done,not_done'],
        ]);

        $todo = Todo::query()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'not_done',
        ]);

        return response()->json([
            'message' => 'Todo created.',
            'data' => $todo,
        ], 201);
    }

    public function update(Request $request, Todo $todo): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
        ]);

        $todo->fill($validated);
        $todo->save();

        return response()->json([
            'message' => 'Todo updated.',
            'data' => $todo->fresh(),
        ]);
    }

    public function updateStatus(Request $request, Todo $todo): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:done,not_done'],
        ]);

        $todo->status = $validated['status'];
        $todo->save();

        return response()->json([
            'message' => 'Todo status updated.',
            'data' => $todo->fresh(),
        ]);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted.',
        ]);
    }
}
