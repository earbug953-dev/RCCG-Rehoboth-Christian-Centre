<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\Event;
use App\Models\Bulletin;
use App\Models\Gallery;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sermons'   => Sermon::count(),
            'events'    => Event::count(),
            'bulletins' => Bulletin::count(),
            'albums'    => Gallery::count(),
            'posts'     => Blog::count(),
        ];

        $recentSermons = Sermon::latest()->take(5)->get();
        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())
                               ->orderBy('event_date')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSermons', 'upcomingEvents'));
    }
}
