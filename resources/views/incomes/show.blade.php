@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Locations</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Locations</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-primary mb-3" href="{{ route('locations.create', ['parent_id' => $location->id]) }}">Add Child Location</a>
            <h1>Location Details</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">Name: {{ $location->name }}</p>
                    <p class="card-text">Status: {{ ucfirst($location->status) }}</p>
                    <p class="card-text">Parent Location: {{ $location->parent ? $location->parent->name : 'N/A' }}</p>
                </div>
            </div>

            @if ($location->parent)
                <h1>Parent Location Details</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="key-datatable" class="table dt-responsive nowrap w-100">
                                
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Parent Location</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <td>{{ $level }}</td>
                                            <td>{{ $currentLocation->name }}</td>
                                            <td>{{ ucfirst($currentLocation->status) }}</td>
                                            <td>{{ $currentLocation->parent ? $currentLocation->parent->name : 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            

            <div>
                <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>  
@endsection