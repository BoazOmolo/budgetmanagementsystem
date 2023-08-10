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
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
            <h1>Budget Details</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">Name: {{ $budget->name }}</p>
                    <p class="card-text">Amount: {{ $budget->amount }}</p>
                    <p class="card-text">Expense: {{ $budget->expenses_id ? $budget->expense->name ?? 'N/A' : '' }}</p>
                    {{-- <p class="card-text">File: {{ $budget->file }}</p> --}}
                    
                    <p class="card-text">Period: {{ $budget->period }}</p>
                    <p class="card-text">Start Date: {{ $budget->date }}</p>
                    <p class="card-text">End Date: {{ $budget->end_date }}</p>
                    <p class="card-text">File:</p>
                    @if ($budget->file)
                        <img src="{{ asset('storage/' . $budget->file) }}" width="300" height="300" alt="File Image">
                    @else
                        <p>N/A</p>
                    @endif
                </div>
            </div>
            <div>
                <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>  
@endsection