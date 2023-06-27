{{-- @extends('layouts.admin')

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
            <!-- end page title -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4 class="card-title">Add Location Details</h4>
                            <form action="{{ route('incomes.store') }}" method="POST">
                                @csrf                 
                                <div class="row mb-3">
                                    <label for="example-number-input" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="amount" id="amount">
                                    </div>
                                </div>
                                <div>
                                    <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Select Period</label>
                                    <div class="col-sm-10">
                                        <select name="period" id ="period"class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="annually">Annually</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Search" name="source_id" id="source_id">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-date-input" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="start_date" id="start_date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-date-input" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="end_date" id="end_date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="file" id="file">
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                                </div>
                            </form>
                            <!-- end row -->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Upcube.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>
<!-- end main content-->
@endsection --}}
@extends('layouts.admin')

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
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4 class="card-title">Add Location Details</h4>
                            <form action="{{ route('incomes.store') }}" method="POST">
                                @csrf                 
                                <div class="row mb-3">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="amount" id="amount" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Select Period</label>
                                    <div class="col-sm-10">
                                        <select name="period" id="period" class="form-select" aria-label="Default select example" required>
                                            <option selected disabled>Select Period</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="annually">Annually</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label for="source_id" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <select name="source" id="source" class="form-select" aria-label="Default select example">
                                            <option selected disabled>Select Source</option>
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}">{{ $source->source }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="source" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <select name="source_id" id="source" class="form-select" aria-label="Default select example" required>
                                            <option selected disabled>Select Source</option>
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}">{{ $source->source }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="start_date" id="start_date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="file" id="file">
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                                </div>
                            </form>
                            <!-- end row -->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Upcube.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->
@endsection
