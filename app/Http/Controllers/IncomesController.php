<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
  
    public function store(Request $request)
    {
        $username = Auth::user()->name;

        $income = new Income();
        $income->name = $request->input('name');
        $income->amount = $request->input('amount');
        $income->period = $request->input('period');
        $income->start_date = $request->input('start_date');
        $income->end_date = $request->input('end_date');
        $income->status = 1;
        $income->createdby = $username;
        $income->updatedby = "";
        $income->deletedby = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
            $fileExtension = strtolower($file->getClientOriginalExtension());
            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('error', 'Only image files are allowed.')->withInput();
            }
        
            $fileName = $file->getClientOriginalName();
            $filePath = 'assets/images/brands/' . $fileName;
            $file->storeAs('public', $filePath);
            $income->file = $filePath;
        }
         
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


        // if ($request->has('source_id')) {
        //     $income->source_id = $request->input('source_id');
        // }

        // if ($request->hasFile('file')) {
        //     if ($income->file) {
        //         Storage::disk('public')->delete($income->file);
        //     }

        //     $file = $request->file('file');
        //     $path = $file->store('income_files', 'public');
        //     $income->file = $path;
        // }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
            if (in_array(strtolower($extension), $allowedExtensions)) {
                if ($income->file) {
                    Storage::disk('public')->delete($income->file);
                }
        
                $path = $file->store('income_files', 'public');
                $income->file = $path;
            } else {
                return redirect()->back()->with('error', 'Only image files are allowed.')->withInput();
            }
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

        $income->status = 0;
        $income->deletedby = $username;
        $income->save();

        $income->delete();

        DB::table('files')
        ->where('type_id', $id)
        ->where('type', 'Incomes')
        ->update(['status' => 0]);

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully.');
    }
}
