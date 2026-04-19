@extends('layouts.app')
@section('title', 'Sermons — RCCG Rehoboth')
@section('content')

<div style="background:linear-gradient(160deg,#0a1c38,#0f2544);" class="py-20 text-center relative overflow-hidden">
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 50% 100%,rgba(200,168,75,0.1),transparent 70%);"></div>
    <div class="relative">
        <div class="section-label justify-center" style="color:#c8a84b;">God's Word</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:3rem;color:white;font-weight:700;">Sermons</h1>
        <p class="text-white/50 mt-3 text-sm">Watch, listen and grow in the Word of God</p>
    </div>
</div>

<div style="background:#fdf8f0;" class="py-16">
<div class="max-w-7xl mx-auto px-6">
    @if($sermons->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($sermons as $sermon)
        <div class="card fade-in group">
            <div class="relative overflow-hidden" style="height:220px;">
                @if($sermon->thumbnail)
                <img src="{{ Storage::url($sermon->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div style="height:100%;background:linear-gradient(135deg,#0f2544,#1a3a6b);display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <div class="text-5xl mb-3">{{ $sermon->file_type==='youtube'?'▶️':'🎤' }}</div>
                    <p style="color:rgba(200,168,75,0.6);font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">{{ $sermon->file_type }}</p>
                </div>
                @endif
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(15,37,68,0.6),transparent);"></div>
                <div style="position:absolute;top:1rem;left:1rem;">
                    <span style="background:rgba(200,168,75,0.9);color:#0f2544;font-size:0.65rem;font-weight:900;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.65rem;border-radius:100px;">{{ $sermon->file_type }}</span>
                </div>
            </div>
            <div class="p-6">
                <p style="color:#c8a84b;font-size:0.7rem;font-weight:900;letter-spacing:0.15em;text-transform:uppercase;" class="mb-2">{{ $sermon->sermon_date->format('d M Y') }}</p>
                <h3 style="font-family:'Playfair Display',serif;font-size:1.15rem;color:#0f2544;font-weight:700;line-height:1.35;" class="mb-2">{{ $sermon->title }}</h3>
                <p class="text-gray-400 text-sm">{{ $sermon->preacher }}@if($sermon->scripture) · <em>{{ $sermon->scripture }}</em>@endif</p>
                <div style="height:1px;background:linear-gradient(90deg,#c8a84b,transparent);margin:1rem 0;"></div>
                <a href="{{ route('sermons.show', $sermon) }}" class="btn-gold text-xs">▶ &nbsp;Listen / Watch</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-12 text-center">{{ $sermons->links() }}</div>
    @else
    <div class="text-center py-24">
        <p class="text-6xl mb-4">🎤</p>
        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#0f2544;">No sermons uploaded yet</h3>
        <p class="text-gray-400 mt-2">Check back after Sunday service!</p>
    </div>
    @endif
</div>
</div>
@endsection
