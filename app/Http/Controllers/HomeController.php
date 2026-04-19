<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use App\Models\Event;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $latestSermon  = Sermon::published()->latest()->first();
        $upcomingEvents = Event::published()->upcoming()->take(3)->get();
        $latestPosts   = Blog::published()->take(3)->get();

        return view('public.home', compact('latestSermon', 'upcomingEvents', 'latestPosts'));
    }
}
