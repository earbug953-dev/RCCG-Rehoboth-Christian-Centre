<?php
namespace App\Http\Controllers;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Gallery::published()->withCount('photos')->paginate(9);
        return view('public.gallery.index', compact('albums'));
    }
}
