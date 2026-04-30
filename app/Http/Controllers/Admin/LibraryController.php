<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        return view('admin.library.index', [
            'items' => Library::orderBy('file_date', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.library.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'type'           => 'required|in:document,image,video',
            'url'            => 'required|string',
            'file_date'      => 'required|date',
            'size'           => 'nullable|string|max:50',
        ]);
        Library::create($data);
        return redirect('/admin/library')->with('success', 'Library item added.');
    }

    public function edit(int $id)
    {
        return view('admin.library.form', ['item' => Library::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = Library::findOrFail($id);
        $data = $request->validate([
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'type'           => 'required|in:document,image,video',
            'url'            => 'required|string',
            'file_date'      => 'required|date',
            'size'           => 'nullable|string|max:50',
        ]);
        $item->update($data);
        return redirect('/admin/library')->with('success', 'Library item updated.');
    }

    public function destroy(int $id)
    {
        Library::findOrFail($id)->delete();
        return redirect('/admin/library')->with('success', 'Library item deleted.');
    }
}
