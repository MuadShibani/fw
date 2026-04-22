<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'url'            => 'nullable|string',
            'file_date'      => 'required|date',
            'size'           => 'nullable|string|max:50',
            'youtube_id'     => 'nullable|string|max:20',
        ]);

        // Handle PDF / file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('library', $filename, 'public');
            $data['url'] = asset('storage/' . $path);
            // Auto-set size
            $bytes = $file->getSize();
            $data['size'] = $bytes > 1048576
                ? round($bytes / 1048576, 1) . ' MB'
                : round($bytes / 1024, 0) . ' KB';
        }

        // Handle YouTube
        if (!empty($data['youtube_id'])) {
            $data['url']  = 'https://www.youtube.com/embed/' . $data['youtube_id'];
            $data['type'] = 'video';
        }

        unset($data['youtube_id']);

        if (empty($data['url'])) {
            return back()->withErrors(['url' => 'Please upload a file, paste a YouTube link, or enter a URL.'])->withInput();
        }

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
            'url'            => 'nullable|string',
            'file_date'      => 'required|date',
            'size'           => 'nullable|string|max:50',
            'youtube_id'     => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('library', $filename, 'public');
            $data['url'] = asset('storage/' . $path);
            $bytes = $file->getSize();
            $data['size'] = $bytes > 1048576
                ? round($bytes / 1048576, 1) . ' MB'
                : round($bytes / 1024, 0) . ' KB';
        }

        if (!empty($data['youtube_id'])) {
            $data['url']  = 'https://www.youtube.com/embed/' . $data['youtube_id'];
            $data['type'] = 'video';
        }

        unset($data['youtube_id']);

        // Keep existing URL if no new upload/link provided
        if (empty($data['url'])) {
            $data['url'] = $item->url;
        }

        $item->update($data);
        return redirect('/admin/library')->with('success', 'Library item updated.');
    }

    public function destroy(int $id)
    {
        Library::findOrFail($id)->delete();
        return redirect('/admin/library')->with('success', 'Library item deleted.');
    }

    /**
     * AJAX: Fetch YouTube metadata (title + thumbnail) from a YouTube URL/ID
     */
    public function youtubeInfo(Request $request)
    {
        $input = $request->input('url', '');

        // Extract video ID from various YouTube URL formats
        $id = null;
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $input, $m)) {
            $id = $m[1];
        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', trim($input))) {
            $id = trim($input);
        }

        if (!$id) {
            return response()->json(['error' => 'Could not extract a YouTube video ID from that URL.'], 422);
        }

        // Use oEmbed to get the title (no API key needed)
        $oembed = @file_get_contents("https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$id}&format=json");
        $title  = 'YouTube Video';
        if ($oembed) {
            $data  = json_decode($oembed, true);
            $title = $data['title'] ?? $title;
        }

        return response()->json([
            'id'        => $id,
            'title'     => $title,
            'thumbnail' => "https://img.youtube.com/vi/{$id}/hqdefault.jpg",
            'embed'     => "https://www.youtube.com/embed/{$id}",
        ]);
    }
}
