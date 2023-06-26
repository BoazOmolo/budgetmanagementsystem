<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('incomes.create');
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
        // $source = Source::find($id);

        $income = new Income();
        $income->amount = $request->input('amount');
        $income->period = $request->input('period');
        $income->source_id = $request->input('source_id');
        $income->start_date = $request->input('start_date');
        $income->end_date = $request->input('end_date');
        $income->file = $request->input('file');
        // $income->source()->associate($sources);
        $income->status = 1;
        $income->createdby = $username;
        $income->updatedby = "";
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $item = YourModel::findOrFail($id);
        // return view('items.edit', compact('item'));
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
        // $item = YourModel::findOrFail($id);
        // $item->amount = $request->input('amount');
        // $item->period = $request->input('period');
        // $item->source_id = $request->input('source_id');
        // $item->start_date = $request->input('start_date');
        // $item->end_date = $request->input('end_date');
        // $item->status = $request->input('status');
        // $item->createdby = $request->input('createdby');
        // $item->updatedby = $request->input('updatedby');
        // $item->save();

        // return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $item = YourModel::findOrFail($id);
        // $item->delete();

        // return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
