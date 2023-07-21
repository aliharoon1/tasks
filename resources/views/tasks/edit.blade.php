@extends('theme.layouts.master')

@section('page_styles')
@endsection

@section('content')
    <h1 class="mt-4">Edit Task</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li class="breadcrumb-item active">Edit Task</li>
    </ol>

    <div class="row justify-content-center">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Edit Task</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.tasks.update', [$project->id, $task->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
@endsection
