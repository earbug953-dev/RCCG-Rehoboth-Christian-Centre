<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'location'     => 'nullable|string|max:255',
            'event_date'   => 'required|date',
            'event_time'   => 'nullable|date_format:H:i',
            'end_date'     => 'nullable|date|after_or_equal:event_date',
            'flyer'        => 'nullable|image|max:4096',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('flyer')) {
            $data['flyer'] = $request->file('flyer')->store('events', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        Event::create($data);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'location'     => 'nullable|string|max:255',
            'event_date'   => 'required|date',
            'event_time'   => 'nullable|date_format:H:i',
            'end_date'     => 'nullable|date|after_or_equal:event_date',
            'flyer'        => 'nullable|image|max:4096',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('flyer')) {
            if ($event->flyer) Storage::disk('public')->delete($event->flyer);
            $data['flyer'] = $request->file('flyer')->store('events', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        $event->update($data);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->flyer) Storage::disk('public')->delete($event->flyer);
        $event->delete();

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event deleted.');
    }
}
