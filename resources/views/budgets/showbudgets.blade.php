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

            <!-- Add the new section for showing budgets for a specific month and year -->
            <!-- Add the new section for showing budgets for a specific month and year -->
            <div class="mt-4">
                <h1>Budgets for {{ $selectedMonth }}</h1>
                <div class="table-responsive">
                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $budget)
                                <tr>
                                    <td>
                                        <p>{{ $budget->date->format('F j, Y') }}</p>
                                    </td>
                                    <td>Ksh: {{ $budget->amount }}</td>
                                    {{-- <td>
                                        <a href="{{ route('budgets.show', ['year' => $budget->date->year, 'month' => $budget->date->month]) }}" class="btn btn-primary">Show Budget</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p><strong>Total Budget Amount: Ksh {{ $totalBudget }}</strong></p>
            </div>
            


        </div>
    </div>
</div>  
@endsection
