@extends('layouts.admin')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Budgets</p>
                                        <h4 class="mb-2">{{ isset($totalbudgets) ? $totalbudgets : '' }}</h4>  
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></p>
                                        <div>     
                                            <a class="btn btn-secondary" href="{{ route('budgets.index') }}">Show latest</a>
                                        </div>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>                                            
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Expenses</p>
                                        <h4 class="mb-2">{{ isset($totalexpenses) ? $totalexpenses : '' }}</h4>
                                        <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"></p>
                                        <div>     
                                            <a class="btn btn-secondary" href="{{ route('expenses.index') }}">Show latest</a>
                                        </div>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="mdi mdi-currency-usd font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Incomes</p>
                                        <h4 class="mb-2">{{ isset($totalincomes) ? $totalincomes : '' }}</h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></p>
                                        <div>     
                                            <a class="btn btn-secondary" href="{{ route('incomes.index') }}">Show latest</a>
                                        </div>
                                    </div>
                                    <div class="avatar-sm">
                                        {{-- <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-user-3-line font-size-24"></i>  
                                        </span> --}}
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    
                </div><!-- end row -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Month</h5>
                            <form action="{{ route('auth.dashboard') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="month" class="form-select" onchange="this.form.submit()">
                                            <option value="">Select a month</option>
                                            <option value="january" {{ $selectedMonth === 'january' ? 'selected' : '' }}>January</option>
                                            <option value="february" {{ $selectedMonth === 'february' ? 'selected' : '' }}>February</option>
                                            <option value="march" {{ $selectedMonth === 'march' ? 'selected' : '' }}>March</option>
                                            <option value="april" {{ $selectedMonth === 'april' ? 'selected' : '' }}>April</option>
                                            <option value="may" {{ $selectedMonth === 'may' ? 'selected' : '' }}>May</option>
                                            <option value="june" {{ $selectedMonth === 'june' ? 'selected' : '' }}>June</option>
                                            <option value="july" {{ $selectedMonth === 'july' ? 'selected' : '' }}>July</option>
                                            <option value="august" {{ $selectedMonth === 'august' ? 'selected' : '' }}>August</option>
                                            <option value="september" {{ $selectedMonth === 'september' ? 'selected' : '' }}>September</option>
                                            <option value="october" {{ $selectedMonth === 'october' ? 'selected' : '' }}>October</option>
                                            <option value="november" {{ $selectedMonth === 'november' ? 'selected' : '' }}>November</option>
                                            <option value="december" {{ $selectedMonth === 'december' ? 'selected' : '' }}>December</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    </div>
                                </div>

                                <h4 class="card-title mb-4">Budgets</h4>

                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                {{-- <th>Name</th> --}}
                                                <th>Amount</th>
                                                <th>Period</th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tbody>
                                                @foreach($budgets as $budget)
                                                    <tr>
                                                        {{-- <td>{{ $budget->name }}</td> --}}
                                                        <td>Ksh: {{ $budget->total }}</td>
                                                        <td>
                                                            <?php
                                                            $carbonDate = \Carbon\Carbon::create($budget->year, $budget->month, 1);
                                                            $monthName = $carbonDate->format('F');
                                                            ?>
                                                            
                                                            <p>{{ $monthName }} {{ $budget->year }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                    
                
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    </div>
                                </div>

                                <h4 class="card-title mb-4">Expenses</h4>

                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                {{-- <th>Name</th> --}}
                                                <th>Amount</th>
                                                <th>Period</th> 
                                                <th>Profit/Loss</th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tbody>
                                                @foreach($expenses as $expense)
                                                    <tr>
                                                        {{-- <td>{{ $expense->name }}</td> --}}
                                                        <td>Ksh: {{ $expense->total }}</td>
                                                        <td>
                                                            <?php
                                                            $carbonDate = \Carbon\Carbon::create($expense->year, $expense->month, 1);
                                                            $monthName = $carbonDate->format('F');
                                                            ?>
                                                            
                                                            <p>{{ $monthName }} {{ $expense->year }}</p>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $matchingBudget = $budgets->where('year', $expense->year)->where('month', $expense->month)->first();
                                                                $difference = $matchingBudget ? $matchingBudget->total - $expense->total : 0;
                                                            @endphp
                                                            @if ($difference > 0)
                                                                <span class="text-success">Ksh +{{ $difference }}</span>
                                                            @elseif ($difference < 0)
                                                                <span class="text-danger">Ksh {{ $difference }}</span>
                                                            @else
                                                                <span class="text-muted">No difference</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                    
                
                </div>
                
                <!-- end row -->
            </div>
            
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
    
@endsection