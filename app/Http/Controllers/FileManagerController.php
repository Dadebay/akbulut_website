<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    //

    public function index()
    {
        return view('admin.filemanager.index');
    }

    public function showFiles()
    {
        $files_with_size = array();
        $files = Storage::disk('catalog')->files();

        foreach ($files as $key => $file) {
            $files_with_size[$key]['url'] = Storage::disk('catalog')->url($file);
            $files_with_size[$key]['name'] = $file;
            $files_with_size[$key]['size'] = Storage::disk('catalog')->size($file);
        }
        // dd($files_with_size);
        return response()->json($files_with_size);
    }

    public function download(Request $request)
    {
        $name = null;

        $file_url = public_path('/storage/catalog/' . $request->name);

        if (!file_exists($file_url)) {
            return response()->json(['msg' => 'file not found'], 404);
        }

        $headers = ['Content-Type: application/pdf'];

        return response()->download($file_url,$request->name,$headers);
    }
}
