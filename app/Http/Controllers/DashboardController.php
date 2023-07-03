<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalbudgets = Budget::sum('amount');
        $totalincomes = Income::sum('amount');
        $totalexpenses = Expense::sum('amount');
        return view('/auth/dashboard', compact('totalbudgets','totalexpenses','totalincomes'));
    }
}