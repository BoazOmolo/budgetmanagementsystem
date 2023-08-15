<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Task;

class DashboardController extends Controller
{
    
   public function dashboard(Request $request)
    {
        // Get the selected month from the request, or set it to null if not present
        $selectedMonth = $request->input('month', null);

        // If a month is selected, fetch data for the selected month; otherwise, fetch data for all months
        $budgetsQuery = Budget::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->when($selectedMonth, function ($query, $selectedMonth) {
                $monthNumber = date('m', strtotime($selectedMonth));
                return $query->whereMonth('date', $monthNumber);
            })
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'asc');

        $expensesQuery = Expense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->when($selectedMonth, function ($query, $selectedMonth) {
                $monthNumber = date('m', strtotime($selectedMonth));
                return $query->whereMonth('date', $monthNumber);
            })
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'asc');

        // Get the total for all budgets, incomes, and expenses
        $totalbudgets = Budget::sum('amount');
        $totalincomes = Income::sum('amount');
        $totalexpenses = Expense::sum('amount');
        $totaltasks = Task::count();

        // Fetch data for budgets and expenses based on the selected month
        $budgets = $budgetsQuery->get();
        $expenses = $expensesQuery->get();

        // Pass the data to the view
        return view('auth.dashboard', compact('totalbudgets', 'totalexpenses', 'totalincomes', 'totaltasks', 'budgets', 'expenses', 'selectedMonth'));
    }
    

   
}
