<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CVDownloadController extends Controller
{
    public function download($cv) {
        $path = storage_path("\\app\\public\\cvs\\" . $cv);

        if(file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json(['error' => 'File not found']);
        }

    }
}