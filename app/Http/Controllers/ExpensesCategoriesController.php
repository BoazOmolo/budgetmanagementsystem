<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExpensesCategory;
use App\Models\Expense;

class ExpensesCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensescategories = ExpensesCategory::where('status', 1)->get();
        return view('expensescategories.index', compact('expensescategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenses = Expense::all();
        return view('expensescategories.create', compact('expenses'));
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

        $expensescategory = new ExpensesCategory();
        $expensescategory->name = $request->input('name');
        $expensescategory->description = $request->input('description');
        // $expensescategory->expenses_id = $request->input('expenses_id');
        $expensescategory->status = 1;
        $expensescategory->createdby = $username;
        $expensescategory->updatedby = "";
        $expensescategory->deletedby = "";

        if ($request->has('expenses_id')) {
            $expensescategory->expenses_id = $request->input('expenses_id');
        }

        $expensescategory->save();

        

        return redirect()->route('expensescategories.index')->with('success', 'Income created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expensescategory = ExpensesCategory::findOrFail($id);
        return view('expensescategories.show', compact('expensescategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expensescategory = ExpensesCategory::findOrFail($id);
        $expenses = Expense::all();
        return view('expensescategories.edit', compact('expensescategory', 'expenses'));
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

        $expensescategory = ExpensesCategory::findOrFail($id);
        $expensescategory->name = $request->input('name');
        $expensescategory->description = $request->input('description');
        $expensescategory->expenses_id = $request->input('expenses_id');
        $expensescategory->status = 1;
        $expensescategory->updatedby = $username;

        $expensescategory->save();

        unset($expensescategory->updated_at);

        return redirect()->route('expensescategories.index')->with('success', 'Expense Category updated successfully.');
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

        $expensescategory = ExpensesCategory::findOrFail($id);

        $expensescategory->status = 0;
        $expensescategory->deletedby = $username;
        $expensescategory->save();

        $expensescategory->delete();

        return redirect()->route('expensescategories.index')->with('success', 'Expense Category deleted successfully.');
    }
}
