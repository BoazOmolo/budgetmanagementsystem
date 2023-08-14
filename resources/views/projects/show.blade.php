@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Projects</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
            <h1>Project Details</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">Name: {{ $project->name }}</p>
                    <p class="card-text">Description: {{ $project->description }}</p>
                    <p class="card-text"> Start Date: {{ $project->start_date }}</p>
                    <p class="card-text"> End Date: {{ $project->end_date }}</p>
                    <p class="card-text">Manager: {{ $project->manager }}</p>
                    <p class="card-text">Status: {{ $project->status }}</p>
                </div>
            </div>
            <h3 class="mt-4">Tasks for {{ $project->name }}</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Task Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $index => $task)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->status }}</td>
                                            <td>
                                                <a class="btn btn-primary upcube-btn" href="{{ route('tasks.show', $task->id ) }}">View</a> 
                                                <a class="btn btn-secondary upcube-btn" href="{{ route('tasks.edit', $task->id ) }}">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task->id ) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger upcube-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <div>
                <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>  
@endsection