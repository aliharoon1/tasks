<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index',compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load('tasks');
        $sortedTasks = $project->tasks->sortBy('priority');
        return view('projects.show',compact('project', 'sortedTasks'));
    }
}
