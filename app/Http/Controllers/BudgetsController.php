<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Budget;
use App\Models\Expense;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::where('status', 1)->get();
        return view('budgets.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenses = Expense::all();
        return view('budgets.create', compact('expenses'));
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

        $budget = new Budget();
        $budget->name = $request->input('name');
        $budget->amount = $request->input('amount');
        $budget->status = 1;
        $budget->createdby = $username;
        $budget->updatedby = "";
        $budget->deletedby = "";

        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = 'assets/images/brands/' . $fileName;
        //     $file->storeAs('public', $filePath);
        //     $budget->file = $filePath;
        // }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
            // Check if the file extension is allowed
            $fileExtension = strtolower($file->getClientOriginalExtension());
            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('error', 'Only image files are allowed.');
            }
        
            $fileName = $file->getClientOriginalName();
            $filePath = 'assets/images/brands/' . $fileName;
            $file->storeAs('public', $filePath);
            $budget->file = $filePath;
        }

        if ($request->has('expenses_id')) {
            $budget->expenses_id = $request->input('expenses_id');
        }

        $budget->save();

        return redirect()->route('budgets.index')->with('success', 'Income created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $budget = Budget::findOrFail($id);
        return view('budgets.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        $expenses = Expense::all();
        return view('budgets.edit', compact('budget', 'expenses'));
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

        $budget = Budget::findOrFail($id);
        $budget->name = $request->input('name');
        $budget->amount = $request->input('amount');
        $budget->expenses_id = $request->input('expenses_id');
        $budget->file = $request->input('file');
        $budget->status = 1;
        $budget->updatedby = $username;
        

        if ($request->hasFile('file')) {
            if ($budget->file) {
                Storage::disk('public')->delete($budget->file);
            }

            // Store the new file
            $file = $request->file('file');
            $path = $file->store('budget_files', 'public');
            $budget->file = $path;
        }

        $budget->save();

        unset($budget->updated_at);

        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
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

        $budget = Budget::findOrFail($id);

        $budget->status = 0;
        $budget->deletedby = $username;
        $budget->save();

        $budget->delete();

        DB::table('files')
            ->where('type_id', $id)
            ->where('type', 'Budgets')
            ->update(['status' => 0]);

        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }
}
