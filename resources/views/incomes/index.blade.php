@extends('layouts.user')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Incomes</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Incomes</a></li>
                                <li class="breadcrumb-item active">Index</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <a class="btn btn-primary mb-3" href="{{ route('incomes.create') }}">Add Income </a>

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
                                        <th>Period</th>
                                        <th>Income source</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomes as $index => $income)
                                        <tr>
                                            <td>{{ $index +=1}}</td>
                                            <td>{{ $income->name }}</td>
                                            <td>{{ $income->amount }}</td>
                                            <td>{{ $income->period }}</td>
                                            {{-- <td>{{ $income->source->source }}</td> --}}
                                            <td>{{ $income->source ? $income->source->source : 'N/A' }}</td>
                                            <td>{{ $income->start_date }}</td>
                                            <td>{{ $income->end_date }}</td>
                                            <td>{{ $income->file ? $income->file : 'N/A' }}</td>
                                            <td>
                                                <a class="btn btn-primary upcube-btn" href="{{ route('incomes.show', $income->id ) }}">View</a>
                                                <a class="btn btn-secondary upcube-btn" href="{{ route('incomes.edit', $income->id ) }}">Edit</a>
                                                <form action="{{ route('incomes.destroy', $income->id ) }}" method="POST" class="d-inline">
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
        </div>
    </div>
</div>
@endsection