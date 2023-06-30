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
        // $files = File::all();
        $files = File::where('status', 1)->get();
        return view('files.index', compact('files'));

        // return view('files.index', compact('files'));
    }

    public function show($id)
    {
        $file = File::findOrFail($id);
        return view('files.show', compact('file'));
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Delete the file associated with the income if it exists
        if ($file->file) {
            // Assuming you have a storage disk named 'public' configured in your filesystems.php
            Storage::disk('public')->delete($file->file);
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}
