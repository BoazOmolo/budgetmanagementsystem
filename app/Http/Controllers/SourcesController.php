<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;

class SourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::where('status', 1)->get();
        return view('sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sources.create');
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

        $source = new Source();
        $source->source = $request->input('source');
        $source->status = 1;
        $source->createdby = $username;
        $source->updatedby = "";
        $source->deletedby = "";
        $source->save();

        Session::flash('successcode','success');
        return redirect()->route('sources.index')->with('success', 'Income created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $source = Source::findOrFail($id);
        return view('sources.show', compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $source = Source::findOrFail($id);
        return view('sources.edit', compact('source'));
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

        $source = Source::findOrFail($id);
        $source->source = $request->input('source');
        $source->status = 1;
        $source->updatedby = $username;
        $source->save();

        unset($source->updated_at);

        Session::flash('successcode','success');
        return redirect()->route('sources.index')->with('success', 'Income source updated successfully.');
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

        $source = Source::findOrFail($id);
        $source->status = 0;
        $source->deletedby = $username;
        $source->save();

        $source->delete();

        Session::flash('successcode','warning');
        return redirect()->route('sources.index')->with('success', 'Income source deleted successfully.');
    }
}
