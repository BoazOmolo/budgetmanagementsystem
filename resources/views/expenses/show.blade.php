@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Expenses</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Expenses</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
            <h1>Expense Details</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">Expense: {{ $expense->parent ? $expense->parent->name : 'N/A' }}</p>
                    <p class="card-text">Name: {{ $expense->name }}</p>
                    <p class="card-text">Date: {{ $expense->date }}</p>
                    <p class="card-text">Description: {{ $expense->description }}</p>
                    <p class="card-text">Amount: {{ $expense->amount }}</p>
                    <p class="card-text">Fees: {{ $expense->fees }}</p>
                    {{-- <p class="card-text">File: {{ $expense->file }}</p> --}}
                    <p class="card-text">File:</p>
                    @if ($expense->file)
                        <img src="{{ asset('storage/' . $expense->file) }}" width="300" height="300" alt="File Image">
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