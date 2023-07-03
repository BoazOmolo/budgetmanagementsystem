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
                                <li class="breadcrumb-item active">Update</li>
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
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h4 class="card-title">Update Income Details</h4>
                            <form action="{{ route('incomes.update', $income->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $income->name }}" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $income->amount }}" type="number" name="amount" id="amount" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Select Period</label>
                                    <div class="col-sm-10">
                                        <select name="period" id="period" class="form-select" aria-label="Default select example" required>
                                            <option selected disabled>Select Period</option>
                                            <option value="weekly" {{ $income->period === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="monthly" {{ $income->period === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="annually" {{ $income->period === 'annually' ? 'selected' : '' }}>Annually</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="source" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <select name="source_id" id="source" class="form-select" aria-label="Default select example" required>
                                            <option value="" selected disabled>Select Source</option>
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}" {{ $income->source_id === $source->id ? 'selected' : '' }}>{{ $source->source }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $income->start_date }}" type="date" name="start_date" id="start_date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{ $income->end_date }}" type="date" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $income->file }}" type="file" class="form-control" name="file" id="file">
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="file" id="file">
                                        @if ($income->file)
                                            <p>Selected file: {{ $income->file }}</p>
                                        @else
                                            <p>No file selected</p>
                                        @endif
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
