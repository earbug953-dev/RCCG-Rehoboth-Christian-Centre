@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome Banner -->
<div style="background:linear-gradient(135deg,#0f2544,#1a3a6b); border-radius:16px; padding:2rem 2.5rem; margin-bottom:2rem; position:relative; overflow:hidden;">
    <div style="position:absolute; right:2rem; top:50%; transform:translateY(-50%); opacity:0.06; font-size:8rem; font-family:'Playfair Display',serif; color:white; line-height:1;">✝</div>
    <p style="color:#c8a84b; font-size:0.7rem; font-weight:900; letter-spacing:0.2em; text-transform:uppercase;" class="mb-1">Welcome back</p>
    <h2 style="font-family:'Playfair Display',serif; color:white; font-size:1.8rem; font-weight:700;">{{ auth()->user()->name ?? 'Admin' }} 👋</h2>
    <p class="text-white/50 text-sm mt-1">Manage your church content from here. God bless your service.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach([
        ['Sermons',   $stats['sermons'],   '🎤', '#eff6ff', '#1d4ed8'],
        ['Events',    $stats['events'],    '📅', '#f5f3ff', '#7c3aed'],
        ['Bulletins', $stats['bulletins'], '📄', '#fffbeb', '#d97706'],
        ['Albums',    $stats['albums'],    '🖼️',  '#fdf2f8', '#db2777'],
        ['Posts',     $stats['posts'],     '✍️',  '#f0fdf4', '#16a34a'],
    ] as [$label, $count, $icon, $bg, $color])
    <div class="stat-card text-center">
        <div style="font-size:1.8rem;" class="mb-2">{{ $icon }}</div>
        <p style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700; color:#0f2544; line-height:1;">{{ $count }}</p>
        <p style="font-size:0.72rem; font-weight:700; color:#9ca3af; letter-spacing:0.08em; text-transform:uppercase;" class="mt-1">{{ $label }}</p>
    </div>
    @endforeach
</div>

<!-- Quick Actions -->
<div style="background:white; border-radius:16px; padding:1.75rem; margin-bottom:2rem; box-shadow:0 1px 15px rgba(0,0,0,0.05);">
    <h3 style="font-family:'Playfair Display',serif; color:#0f2544; font-size:1.1rem; font-weight:700;" class="mb-4">Quick Upload</h3>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.sermons.create') }}" class="btn-gold">+ Sermon</a>
        <a href="{{ route('admin.events.create') }}" class="btn-gold">+ Event</a>
        <a href="{{ route('admin.bulletins.create') }}" class="btn-gold">+ Bulletin</a>
        <a href="{{ route('admin.gallery.create') }}" class="btn-gold">+ Album</a>
        <a href="{{ route('admin.blog.create') }}" class="btn-gold">+ Blog Post</a>
    </div>
</div>

<!-- Tables -->
<div class="grid lg:grid-cols-2 gap-6">

    <!-- Recent Sermons -->
    <div style="background:white; border-radius:16px; overflow:hidden; box-shadow:0 1px 15px rgba(0,0,0,0.05);">
        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f9fafb; display:flex; align-items:center; justify-content:space-between;">
            <h3 style="font-family:'Playfair Display',serif; color:#0f2544; font-weight:700;">Recent Sermons</h3>
            <a href="{{ route('admin.sermons.index') }}" style="color:#c8a84b; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">View all →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentSermons as $sermon)
            <div style="padding:0.9rem 1.5rem;" class="flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div style="width:36px; height:36px; background:#eff6ff; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0;">🎤</div>
                    <div>
                        <p style="font-size:0.85rem; font-weight:600; color:#1f2937;" class="truncate max-w-48">{{ $sermon->title }}</p>
                        <p style="font-size:0.72rem; color:#9ca3af;">{{ $sermon->preacher }} · {{ $sermon->sermon_date->format('d M Y') }}</p>
                    </div>
                </div>
                @if($sermon->is_published)
                    <span class="badge-green">Live</span>
                @else
                    <span class="badge-gray">Draft</span>
                @endif
            </div>
            @empty
            <div style="padding:2rem; text-align:center; color:#9ca3af;">
                <p class="text-3xl mb-2">🎤</p>
                <p class="text-sm">No sermons yet</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Upcoming Events -->
    <div style="background:white; border-radius:16px; overflow:hidden; box-shadow:0 1px 15px rgba(0,0,0,0.05);">
        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f9fafb; display:flex; align-items:center; justify-content:space-between;">
            <h3 style="font-family:'Playfair Display',serif; color:#0f2544; font-weight:700;">Upcoming Events</h3>
            <a href="{{ route('admin.events.index') }}" style="color:#c8a84b; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">View all →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($upcomingEvents as $event)
            <div style="padding:0.9rem 1.5rem;" class="flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div style="width:36px; height:36px; background:#f5f3ff; border-radius:8px; display:flex; flex-direction:column; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="font-size:0.65rem; font-weight:900; color:#7c3aed; line-height:1;">{{ $event->event_date->format('d') }}</span>
                        <span style="font-size:0.5rem; font-weight:700; color:#a78bfa; line-height:1;">{{ $event->event_date->format('M') }}</span>
                    </div>
                    <div>
                        <p style="font-size:0.85rem; font-weight:600; color:#1f2937;" class="truncate max-w-48">{{ $event->title }}</p>
                        <p style="font-size:0.72rem; color:#9ca3af;">{{ $event->location ?? 'No location set' }}</p>
                    </div>
                </div>
                @if($event->is_published)
                    <span class="badge-green">Published</span>
                @else
                    <span class="badge-gray">Draft</span>
                @endif
            </div>
            @empty
            <div style="padding:2rem; text-align:center; color:#9ca3af;">
                <p class="text-3xl mb-2">📅</p>
                <p class="text-sm">No upcoming events</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
