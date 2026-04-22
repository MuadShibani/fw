<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,xls,ppt,pptx,zip,rar|max:20480',
        ]);

        $file     = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs('library', $filename, 'public');

        $bytes = $file->getSize();
        $size  = $bytes > 1048576
            ? round($bytes / 1048576, 1) . ' MB'
            : round($bytes / 1024, 0) . ' KB';

        return response()->json([
            'url'  => asset('storage/' . $path),
            'size' => $size,
            'name' => $file->getClientOriginalName(),
        ]);
    }
}
