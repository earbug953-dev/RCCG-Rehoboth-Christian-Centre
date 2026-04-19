<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SermonController extends Controller
{
    public function index()
    {
        $sermons = Sermon::latest()->paginate(15);
        return view('admin.sermons.index', compact('sermons'));
    }

    public function create()
    {
        return view('admin.sermons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'preacher'     => 'required|string|max:255',
            'scripture'    => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'file_type'    => 'required|in:audio,video,youtube',
            'sermon_file'  => 'nullable|file|mimes:mp3,mp4,wav,ogg,webm|max:512000',
            'youtube_url'  => 'nullable|url',
            'thumbnail'    => 'nullable|image|max:2048',
            'sermon_date'  => 'required|date',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('sermon_file')) {
            $data['file_path'] = $request->file('sermon_file')->store('sermons', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('sermons/thumbnails', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        Sermon::create($data);

        return redirect()->route('admin.sermons.index')
                         ->with('success', 'Sermon uploaded successfully!');
    }

    public function edit(Sermon $sermon)
    {
        return view('admin.sermons.edit', compact('sermon'));
    }

    public function update(Request $request, Sermon $sermon)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'preacher'     => 'required|string|max:255',
            'scripture'    => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'file_type'    => 'required|in:audio,video,youtube',
            'sermon_file'  => 'nullable|file|mimes:mp3,mp4,wav,ogg,webm|max:512000',
            'youtube_url'  => 'nullable|url',
            'thumbnail'    => 'nullable|image|max:2048',
            'sermon_date'  => 'required|date',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('sermon_file')) {
            if ($sermon->file_path) Storage::disk('public')->delete($sermon->file_path);
            $data['file_path'] = $request->file('sermon_file')->store('sermons', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($sermon->thumbnail) Storage::disk('public')->delete($sermon->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('sermons/thumbnails', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $sermon->update($data);

        return redirect()->route('admin.sermons.index')
                         ->with('success', 'Sermon updated successfully!');
    }

    public function destroy(Sermon $sermon)
    {
        if ($sermon->file_path) Storage::disk('public')->delete($sermon->file_path);
        if ($sermon->thumbnail)  Storage::disk('public')->delete($sermon->thumbnail);
        $sermon->delete();

        return redirect()->route('admin.sermons.index')
                         ->with('success', 'Sermon deleted.');
    }
}
