<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Auth;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:4096'
        ]);

        $storeFile = new Document;

        if ($request->file()) {
            $filename = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('files', $filename);

            $storeFile->user_id = $request->user()->id;
            $storeFile->filename = $filename;
            $storeFile->save();

            return redirect()->route('landlord.index')->with('success', 'File has been uploaded');
        }
    }

    public function delete($id)
    {
        $file = Document::find($id);

        if (Auth::user()->id !== $file->user_id) {
            return redirect()->route('landlord.index')->with('error', 'Unauthorized Action');
        }

        Storage::delete('files/'.$file->filename);

        if ($file->destroy($id)) {
            return redirect()->route('landlord.index')->with('success', 'File has been deleted');
        }
    }
}
