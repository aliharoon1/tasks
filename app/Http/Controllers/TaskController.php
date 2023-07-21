<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::select('id','name','priority')->where('project_id', $request->project)->orderBy('');
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $maxPriority = $project->tasks()->max('priority');
        $nextPriority = $maxPriority + 1;

        $task = new Task();
        $task->name = $request->input('name');
        $task->priority = $nextPriority;

        $project->tasks()->save($task);

        return response()->json([
            'success'=> true,
            'data'=> '',
        ]);
    }

    public function show(Task $task)
    {
        dd($task);
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project','task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.show',$project->id)->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show',$project->id)->with('success', 'Task deleted successfully.');
    }

    public function updateOrder(Request $request, $projectId)
    {
        $sortedData = $request->input('sortedData');

        foreach ($sortedData as $index => $taskId) {
            Task::updatePriority($taskId, $index + 1);
        }

        return response()->json(['success' => true, 'message' => 'Task order updated successfully.']);
    }
}
