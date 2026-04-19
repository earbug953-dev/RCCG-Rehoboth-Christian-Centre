@extends('layouts.app')
@section('title', 'Events — RCCG Rehoboth')
@section('content')

<div style="background:linear-gradient(160deg,#0a1c38,#0f2544);" class="py-20 text-center relative overflow-hidden">
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 50% 100%,rgba(200,168,75,0.1),transparent 70%);"></div>
    <div class="relative">
        <div class="section-label justify-center" style="color:#c8a84b;">Church Calendar</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:3rem;color:white;font-weight:700;">Events</h1>
        <p class="text-white/50 mt-3 text-sm">Stay connected with what's happening at Rehoboth</p>
    </div>
</div>

<div style="background:#fdf8f0;" class="py-16">
<div class="max-w-7xl mx-auto px-6">
    @if($upcoming->count())
    <div class="mb-12">
        <div class="flex items-center gap-4 mb-8">
            <div style="height:2px;flex:1;background:linear-gradient(90deg,#c8a84b,transparent);"></div>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#0f2544;white-space:nowrap;">Upcoming Events</h2>
            <div style="height:2px;flex:1;background:linear-gradient(to left,#c8a84b,transparent);"></div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($upcoming as $event)
            <div class="card fade-in group">
                @if($event->flyer)
                <div class="overflow-hidden" style="height:220px;">
                    <img src="{{ Storage::url($event->flyer) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                @else
                <div style="height:220px;background:linear-gradient(135deg,#0f2544,#1a3a6b);display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <p style="font-family:'Playfair Display',serif;color:#c8a84b;font-size:4rem;font-weight:700;line-height:1;">{{ $event->event_date->format('d') }}</p>
                    <p class="text-white/60 font-semibold">{{ $event->event_date->format('F Y') }}</p>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span style="background:#fef3d0;color:#a6892f;font-size:0.65rem;font-weight:900;letter-spacing:0.1em;text-transform:uppercase;padding:0.2rem 0.65rem;border-radius:100px;">📅 {{ $event->event_date->format('d M Y') }}</span>
                        @if($event->event_time)<span style="background:#eff6ff;color:#1d4ed8;font-size:0.65rem;font-weight:900;letter-spacing:0.1em;text-transform:uppercase;padding:0.2rem 0.65rem;border-radius:100px;">{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>@endif
                    </div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.2rem;color:#0f2544;font-weight:700;line-height:1.35;" class="mb-2">{{ $event->title }}</h3>
                    @if($event->location)<p class="text-gray-400 text-sm">📍 {{ $event->location }}</p>@endif
                    <div style="height:1px;background:linear-gradient(90deg,#c8a84b,transparent);margin:1rem 0;"></div>
                    <a href="{{ route('events.show', $event) }}" style="color:#c8a84b;font-weight:700;font-size:0.75rem;letter-spacing:0.08em;text-transform:uppercase;">Find Out More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="text-center py-20">
        <p class="text-6xl mb-4">📅</p>
        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#0f2544;">No upcoming events</h3>
        <p class="text-gray-400 mt-2">Check back soon!</p>
    </div>
    @endif

    @if($past->count())
    <div class="pt-10 mt-10 border-t border-gray-200">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;color:#9ca3af;" class="mb-6">Past Events</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($past as $event)
            <a href="{{ route('events.show', $event) }}" style="background:white;border-radius:10px;padding:1.25rem;border:1px solid #f3f4f6;display:block;opacity:0.7;transition:all 0.2s;" onmouseover="this.style.opacity='1';this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.opacity='0.7';this.style.boxShadow='none';">
                <p style="color:#c8a84b;font-size:0.7rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;" class="mb-1">{{ $event->event_date->format('d M Y') }}</p>
                <h3 style="font-size:0.9rem;font-weight:700;color:#0f2544;">{{ $event->title }}</h3>
                @if($event->location)<p class="text-gray-400 text-xs mt-1">📍 {{ $event->location }}</p>@endif
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
</div>
@endsection
