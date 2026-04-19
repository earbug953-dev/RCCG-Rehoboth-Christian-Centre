<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'excerpt'      => 'nullable|string',
            'body'         => 'required|string',
            'cover_image'  => 'nullable|image|max:4096',
            'is_published' => 'boolean',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Post published successfully!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'excerpt'      => 'nullable|string',
            'body'         => 'required|string',
            'cover_image'  => 'nullable|image|max:4096',
            'is_published' => 'boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && ! $blog->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image) Storage::disk('public')->delete($blog->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->cover_image) Storage::disk('public')->delete($blog->cover_image);
        $blog->delete();

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Post deleted.');
    }
}
