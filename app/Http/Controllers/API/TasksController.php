<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function index()
    {
        if (auth()->user()->user_type != 1) {
            $tasks = Task::where('assignee', auth()->user()->id)->get();
            return response()->json(['Your assigned tasks' => $tasks], 200);
        } else {
            $tasks = Task::all();
            return response()->json(['All Tasks' => $tasks], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|string',
            'assignee' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $task = new Task($validator->validated());
        $task->save();

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    public function show(Task $task)
    {
        if (auth()->user()->user_type != 1 && auth()->user()->id != $task->assignee) {
            return response()->json(['message' => 'You do not have permissions to do this'], 403);
        }

        return response()->json(['task' => $task]);
    }

    public function destroy(Task $task)
    {
        if (auth()->user()->user_type != 1 && auth()->user()->id != $task->assignee) {
            return response()->json(['message' => 'You do not have permissions to do this'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function update(Request $request, Task $task)
    {
        if (auth()->user()->user_type != 1 && auth()->user()->id != $task->assignee) {
            return response()->json(['message' => 'You do not have permissions to do this'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|string',
            'assignee' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $task->update($validator->validated());

        return response()->json(['message' => 'Task updated successfully']);
    }
}
