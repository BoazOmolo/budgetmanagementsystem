<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // $budgetsname = Budget::with('budgets')->get();

        $totalbudgets = Budget::sum('amount');
        $totalincomes = Income::sum('amount');
        $totalexpenses = Expense::sum('amount');
    
        $selectedMonth = $request->input('month');
        
        $budgetsQuery = Budget::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'asc');
        
        $expensesQuery = Expense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'asc');
    
        if ($selectedMonth) {
            $monthNumber = date('m', strtotime($selectedMonth));
            $budgetsQuery->whereMonth('date', $monthNumber);
            $expensesQuery->whereMonth('date', $monthNumber);
        }
    
        $budgets = $budgetsQuery->get();
        $expenses = $expensesQuery->get();
    
        return view('/auth/dashboard', compact('totalbudgets','totalexpenses','totalincomes','budgets', 'expenses', 'selectedMonth',));
    }
    

   
}
