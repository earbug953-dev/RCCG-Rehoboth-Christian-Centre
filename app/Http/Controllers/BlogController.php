<?php
namespace App\Http\Controllers;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::published()->paginate(9);
        return view('public.blog.index', compact('posts'));
    }

    public function show(Blog $blog)
    {
        abort_unless($blog->is_published, 404);
        $related = Blog::published()->where('id', '!=', $blog->id)->take(3)->get();
        return view('public.blog.show', compact('blog', 'related'));
    }
}
