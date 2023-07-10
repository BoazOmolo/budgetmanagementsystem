@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Budgets</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Budgets</a></li>
                                <li class="breadcrumb-item active">Index</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <a class="btn btn-primary mb-3" href="{{ route('budgets.create') }}">Add Budget </a>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Expenses</th>
                                        <th>File</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($budgets as $index => $budget)
                                        <tr>
                                            <td>{{ $index +=1}}</td>
                                            <td>{{ $budget->name }}</td>
                                            <td>{{ $budget->amount }}</td>
                                            {{-- <td>{{ $budget->expenses_id ? $budget->expense->name : 'N/A' }}</td> --}}
                                            <td>{{ $budget->expenses_id ? ($budget->expense ? $budget->expense->name : 'N/A') : 'N/A' }}</td>
                                            <td>{{ $budget->file ? $budget->file : 'N/A' }}</td>
                                            <td>{{ $budget->date }}</td>
                                            <td>
                                                <a class="btn btn-primary upcube-btn" href="{{ route('budgets.show', $budget->id ) }}">View</a>
                                                <a class="btn btn-secondary upcube-btn" href="{{ route('budgets.edit', $budget->id ) }}">Edit</a>
                                                <form action="{{ route('budgets.destroy', $budget->id ) }}" method="POST" class="d-inline">
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
            </div>
@endsection