@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New User</h4>

                            <form method="POST" action="{{ route('admin.createuser') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" id="name" required value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">E-Mail Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="email" id="email" required value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div>
                                    <button class="btn btn-primary" type="submit">Create User</button>
                                    <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="role_as">{{ __('Role') }}</label>
                                    <select id="role_as" class="form-control" name="role_as" required>
                                        <option value="0">Normal User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div> --}}    
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
