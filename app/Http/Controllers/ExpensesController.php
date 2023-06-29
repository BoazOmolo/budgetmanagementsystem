<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Expense;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('status', 1)->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = Auth::user()->name;

        $expense = new Expense();
        // $expense->expenses_id = $request->input('expenses_id');
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->fees = $request->input('fees');
        // $expense->file = $request->input('file');
        $expense->status = 1;
        $expense->createdby = $username;
        $expense->updatedby = "";
        $expense->deletedby = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'assets/images/brands/' . $fileName;
            $file->storeAs('public', $filePath);
            $expense->file = $filePath;
        }

        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = Auth::user()->name;

        $expense = Expense::findOrFail($id);
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->fees = $request->input('fees');
        $expense->file = $request->input('file');
        $expense->status = 1;
        $expense->updatedby = $username;

        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($expense->file) {
                // Assuming you have a storage disk named 'public' configured in your filesystems.php
                Storage::disk('public')->delete($expense->file);
            }

            // Store the new file
            $file = $request->file('file');
            $path = $file->store('expense_files', 'public');
            $expense->file = $path;
        }

        $expense->save();

        unset($expense->updated_at);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $username = Auth::user()->name;

        $expense = Expense::findOrFail($id);

        // Delete the file associated with the income if it exists
        if ($expense->file) {
            // Assuming you have a storage disk named 'public' configured in your filesystems.php
            Storage::disk('public')->delete($expense->file);
        }

        $expense->status = 0;
        $expense->deletedby = $username;
        $expense->save();

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
