<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        // Retrieve all expenses
        $expenses = Expense::all();

        return response()->json($expenses);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'parent_id' => 'required|string|max:255',
            'expensescategory_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'fees' => 'required|numeric',
        ]);

        // Create a new expense with the validated data
        $expense = Expense::create($validatedData);

        return response()->json(['message' => 'Expense created successfully']);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'parent_id' => 'required|string|max:255',
            'expensescategory_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'fees' => 'required|numeric',
        ]);

        // Find the expense by ID
        $expense = Expense::findOrFail($id);

        // Update the expense with the validated data
        $expense->update($validatedData);

        return response()->json(['message' => 'Expense updated successfully']);
    }

    public function destroy($id)
    {
        // Find the expense by ID
        $expense = Expense::findOrFail($id);

        // Delete the expense
        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully']);
    }
}
