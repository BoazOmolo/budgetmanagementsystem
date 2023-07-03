<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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

    public function create(Request $request)
    {
        $parent_id = $request->query("parent_id");
        $expenses = Expense::pluck('name', 'id');

        return view('expenses.create',compact('expenses'))->with(['parent_id' => $parent_id ?? null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'status' => 'required|in:completed,incomplete',
        //     'parent_id' => 'nullable|exists:locations,id'
        // ]);

        $username = Auth::user()->name;

        $expense = new Expense();
        $expense->parent_id = $request->input('parent_id');
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->fees = $request->input('fees');
        $expense->status = 1;
        $expense->createdby = $username;
        $expense->updatedby = "";
        $expense->deletedby = "";

        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = 'assets/images/brands/' . $fileName;
        //     $file->storeAs('public', $filePath);
        //     $expense->file = $filePath;
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
    public function edit(Request $request,$id)
    {
        $expense = Expense::findOrFail($id);
        $parent_id = $request->query("parent_id");
        $expenses = Expense::pluck('name', 'id');
        return view('expenses.edit', compact('expense', 'expenses', 'parent_id'));
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
        $expense->parent_id = $request->input('parent_id');
        $expense->name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->fees = $request->input('fees');
        $expense->file = $request->input('file');
        $expense->status = 1;
        $expense->updatedby = $username;

        if ($request->hasFile('file')) {
            if ($expense->file) {
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

        $expense->status = 0;
        $expense->deletedby = $username;
        $expense->save();

        $expense->delete();

        DB::table('files')
        ->where('type_id', $id)
        ->where('type', 'Expenses')
        ->update(['status' => 0]);

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
