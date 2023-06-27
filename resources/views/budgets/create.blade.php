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
                                <li class="breadcrumb-item active">Create</li>
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
                            <form action="{{ route('budgets.store') }}" method="POST">
                                @csrf                 
                                <div class="row mb-3">
                                    <label for="example-number-input" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="amount" id="amount">
                                    </div>
                                </div> 
                                {{-- <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Search" name="expenses_id" id="expenses_id">
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="source" class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <select name="expenses_id" id="source" class="form-select" aria-label="Default select example">
                                            <option selected disabled>Select Source</option>
                                            @foreach ($expenses as $expense)
                                                <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                                            @endforeach
                                        </select>
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