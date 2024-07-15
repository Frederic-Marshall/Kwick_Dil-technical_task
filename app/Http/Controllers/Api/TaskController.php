<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        return Task::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => "Task has been removed",
        ]);
    }

    // Метод поиска по крайнему сроку и статусу
    public function search(Request $request)
    {
        $status = $request->input('status');
        $deadline = $request->input('deadline');
        $tasks = Task::when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->when($deadline, function ($query) use ($deadline) {
            return $query->whereDate('deadline', $deadline);
        })
        ->get();
        return $tasks;
    }
}
