<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Gallery::withCount('photos')->latest()->paginate(12);
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'cover_photo'  => 'nullable|image|max:4096',
            'photos'       => 'nullable|array',
            'photos.*'     => 'image|max:8192',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('gallery/covers', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        unset($data['photos']);

        $album = Gallery::create($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                $path = $photo->store('gallery/' . $album->id, 'public');
                Photo::create([
                    'gallery_id' => $album->id,
                    'file_path'  => $path,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Album created successfully!');
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load('photos');
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'cover_photo'  => 'nullable|image|max:4096',
            'photos'       => 'nullable|array',
            'photos.*'     => 'image|max:8192',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('cover_photo')) {
            if ($gallery->cover_photo) Storage::disk('public')->delete($gallery->cover_photo);
            $data['cover_photo'] = $request->file('cover_photo')->store('gallery/covers', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        unset($data['photos']);
        $gallery->update($data);

        if ($request->hasFile('photos')) {
            $lastOrder = $gallery->photos()->max('sort_order') ?? -1;
            foreach ($request->file('photos') as $i => $photo) {
                $path = $photo->store('gallery/' . $gallery->id, 'public');
                Photo::create([
                    'gallery_id' => $gallery->id,
                    'file_path'  => $path,
                    'sort_order' => $lastOrder + $i + 1,
                ]);
            }
        }

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Album updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        foreach ($gallery->photos as $photo) {
            Storage::disk('public')->delete($photo->file_path);
        }
        if ($gallery->cover_photo) Storage::disk('public')->delete($gallery->cover_photo);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Album deleted.');
    }
}
