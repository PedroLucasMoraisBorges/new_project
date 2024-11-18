<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json([
            'task' => $task
        ]);
        return $task;
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $task;
    }

    public function complete(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'is_complete' => true
        ]);

        return response()->json([
            'message' => 'Tarefa marcada como completa',
            'data' => $task
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_complete' => 'required|boolean',
        ]);

        if ($validatedData['is_complete'] === true) {
            $validatedData['dt_close'] = now();
        } else {
            $validatedData['dt_close'] = null;
        }

        $task->update($validatedData);

        return $task;
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
}
