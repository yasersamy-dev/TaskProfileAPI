<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
   public function index()
 {
    $tasks = auth()->user()->tasks;
    return response()->json($tasks, 200);
 }


    public function store(StoreTaskRequest $request){
        $task = Task::create([
      'title' => $request->title,
      'description' => $request->description,
      'priority' => $request->priority,
      'user_id' => auth()->id(),
   ]);

        return response()->json($task, 200);
    }

    public function update(UpdateTaskRequest $request, Task $task)
{
    if ($task->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $task->update($request->validated());
    return response()->json($task, 200);
}

    public function show($id){
        $task = Task::find($id);
        if (!$task) {
       return response()->json(['message' => 'Task not found'], 404);
}
        return response()->json($task, 200);
    }

    public function destroy(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $task->delete();
    return response()->json(['message' => 'Task deleted'], 200);
}
}
