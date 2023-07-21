@extends('theme.layouts.master')

@section('page_scripts')
@endsection

@section('content')
    <h1 class="mt-4">Projects</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Projects</li>
    </ol>
    <div class="row justify-content-center">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No Project found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

@section('page_scripts')
@endsection

