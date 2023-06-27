<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\File;

class FilesController extends Controller
{
    public function index()
    {
        // Retrieve files from the files table
        $files = File::all();

        return view('files.index', compact('files'));
    }

    // Rest of the methods...

    public function store(Request $request)
    {

        $username = Auth::user()->name;
        
        $file = $request->file('file');
        $file->store('files');
        $fileType = $request->input('type');

        // Insert the file type into the files table
        $fileEntry = new File();
        $fileEntry->type = $fileType;
        $fileEntry->type_id = $file->id;
        $fileEntry->status = 1; 
        $fileEntry->createdby = Auth::user()->name;
        $fileEntry->updatedby = '';
        $fileEntry->save();

        return redirect()->back();
    }
}
