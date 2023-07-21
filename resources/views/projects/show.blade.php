{{--@extends('theme.layouts.master')--}}

{{--@section('page_styles')--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <h1 class="mt-4">Project: {{ $project->name }}</h1>--}}
{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Dashboard</a></li>--}}
{{--        <li class="breadcrumb-item"><a href="{{route('projects.index')}}">Projects</a></li>--}}
{{--        <li class="breadcrumb-item active">{{ $project->name }}</li>--}}
{{--    </ol>--}}

{{--    <div class="row justify-content-center">--}}
{{--        <div class="card mb-4">--}}
{{--            <div class="card-header">--}}
{{--                <div class="d-flex justify-content-between ">--}}
{{--                    <h4>Tasks</h4>--}}
{{--                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">--}}
{{--                        Create Task--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                @if (count($project->tasks) > 0)--}}
{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="col">Name</th>--}}
{{--                            <th scope="col">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($project->tasks as $task)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $task->name }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('projects.tasks.edit', [$project->id,$task->id]) }}" class="btn btn-secondary">Edit</a>--}}
{{--                                    <form action="{{ route('projects.tasks.destroy',[$project->id,$task->id]) }}" method="POST" class="d-inline">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                @else--}}
{{--                    <p>No tasks found for this project.</p>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="createTaskForm">--}}
{{--                        @csrf--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="name" class="form-label">Name</label>--}}
{{--                            <input type="text" class="form-control" id="name" name="name" required>--}}
{{--                        </div>--}}
{{--                        <a href="javascript:void(0)" id="btnStoreTask" class="btn btn-primary">Create</a>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@section('page_scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('body').on('click', '#btnStoreTask', function () {--}}
{{--                // event.preventDefault();--}}
{{--                alert()--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("projects.tasks.store", ["project" => $project->id]) }}',--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        'name': $('#name').val()--}}
{{--                    },--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        if (response.success) {--}}
{{--                            $('#createTaskModal').modal('hide');--}}
{{--                            window.location.reload();--}}
{{--                        } else {--}}
{{--                            console.error(response.message);--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.error('An error occurred while creating the task.', error);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}


@extends('theme.layouts.master')

@section('page_styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    <h1 class="mt-4">Project: {{ $project->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('projects.index')}}">Projects</a></li>
        <li class="breadcrumb-item active">{{ $project->name }}</li>
    </ol>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Tasks</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createTaskModal">
                        Create Task
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (count($project->tasks) > 0)
                    <table class="table" id="tasksTable">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sortedTasks as $task)
                            <tr data-task-id="{{ $task->id }}">
                                <td>{{ $task->name }}</td>
                                <td>
                                    <a href="{{ route('projects.tasks.edit', [$project->id,$task->id]) }}"
                                       class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('projects.tasks.destroy',[$project->id,$task->id]) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No tasks found for this project.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="button" id="btnStoreTask" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            $("#tasksTable tbody").sortable({
                axis: "y",
                update: function (event, ui) {
                    var sortedData = $(this).sortable("toArray", {
                        attribute: "data-task-id"
                    });

                    $.ajax({
                        url: "{{ route('projects.tasks.updateOrder', $project->id) }}",
                        method: "PUT",
                        data: {
                            sortedData: sortedData
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function (response) {
                            if (response.success) {
                                console.log("Task order updated successfully.");
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("An error occurred while updating task order.", error);
                        }
                    });
                }
            });

            $('body').on('click', '#btnStoreTask', function () {
                $.ajax({
                    url: '{{ route("projects.tasks.store", ["project" => $project->id]) }}',
                    method: 'POST',
                    data: {
                        'name': $('#name').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#createTaskModal').modal('hide');
                            window.location.reload();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('An error occurred while creating the task.', error);
                    }
                });
            });
        });
    </script>
@endsection

