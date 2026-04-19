<?php
namespace App\Http\Controllers;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcoming = Event::published()->upcoming()->paginate(9);
        $past     = Event::published()->past()->paginate(6);
        return view('public.events.index', compact('upcoming', 'past'));
    }

    public function show(Event $event)
    {
        abort_unless($event->is_published, 404);
        return view('public.events.show', compact('event'));
    }
}
