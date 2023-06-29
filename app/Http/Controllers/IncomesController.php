<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Income;
use App\Models\Source;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::where('status', 1)->get();
        return view('incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $sources = Source::all();
        return view('incomes.create', compact('sources'));
        // return view('incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        // $username = Auth::user()->name;
        // // $source = Source::find($id);
        // // $source = Source::where('source_id', $request->input('source'))->first();
        // $source = Source::where('source', $request->input('source'))->first();

        
        // if ($source) {
        //     $income = new Income();
        //     $income->amount = $request->input('amount');
        //     $income->period = $request->input('period');
        //     $income->source_id = $source->id;
        //     $income->start_date = $request->input('start_date');
        //     $income->end_date = $request->input('end_date');
        //     $income->file = $request->input('file');
        //     $income->status = 1;
        //     $income->createdby = $username;
        //     $income->updatedby = "";
        //     $income->save();

        // } else {
        //     \Log::error('Source not found');
        //     return redirect()->back()->with('error', 'Source not found.');
        // }

        // return redirect()->route('incomes.index')->with('success', 'Income created successfully.');
        
    // }
    public function store(Request $request)
    {
        $username = Auth::user()->name;

        $income = new Income();
        $income->name = $request->input('name');
        $income->amount = $request->input('amount');
        $income->period = $request->input('period');
        $income->start_date = $request->input('start_date');
        $income->end_date = $request->input('end_date');
        $income->file = $request->input('file');
        $income->status = 1;
        $income->createdby = $username;
        $income->updatedby = "";
        $income->deletedby = "";

        // Check if source is selected
        // Check if source is selected
        // if ($request->has('source')) {
        //     $source = Source::where('source', $request->input('source'))->first();

        //     // Check if source is found
        //     if ($source) {
        //         $income->source_id = $source->id;
        //     }
        // }
        // Check if source_id is selected
        if ($request->has('source_id')) {
            $income->source_id = $request->input('source_id');
        }

        $income->save();

        return redirect()->route('incomes.index')->with('success', 'Income created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = Income::findOrFail($id);
        return view('incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        $sources = Source::all();
        return view('incomes.edit', compact('income', 'sources'));
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

        $income = Income::findOrFail($id);
        $income->name = $request->input('name');
        $income->amount = $request->input('amount');
        $income->period = $request->input('period');
        $income->start_date = $request->input('start_date');
        $income->end_date = $request->input('end_date');
        $income->status = 1;
        $income->updatedby = $username;


        if ($request->has('source_id')) {
            $income->source_id = $request->input('source_id');
        }

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($income->file) {
                // Assuming you have a storage disk named 'public' configured in your filesystems.php
                Storage::disk('public')->delete($income->file);
            }

            // Store the new file
            $file = $request->file('file');
            $path = $file->store('income_files', 'public');
            $income->file = $path;
        }

        $income->save();

        unset($income->updated_at);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully.');
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

        $income = Income::findOrFail($id);

        // Delete the file associated with the income if it exists
        if ($income->file) {
            // Assuming you have a storage disk named 'public' configured in your filesystems.php
            Storage::disk('public')->delete($income->file);
        }
        $income->status = 0;
        $income->deletedby = $username;
        $income->save();

        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully.');
    }
}
