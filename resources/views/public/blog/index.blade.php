@extends('layouts.app')
@section('title', 'Blog & Devotionals — RCCG Rehoboth')
@section('content')

<div style="background:linear-gradient(160deg,#0a1c38,#0f2544);" class="py-20 text-center relative overflow-hidden">
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 50% 100%,rgba(200,168,75,0.1),transparent 70%);"></div>
    <div class="relative">
        <div class="section-label justify-center" style="color:#c8a84b;">Read & Reflect</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:3rem;color:white;font-weight:700;">Blog & Devotionals</h1>
        <p class="text-white/50 mt-3 text-sm">Words of encouragement, teaching and spiritual inspiration</p>
    </div>
</div>

<div style="background:#fdf8f0;" class="py-16">
<div class="max-w-7xl mx-auto px-6">
    @if($posts->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <div class="card fade-in group">
            @if($post->cover_image)
            <div class="overflow-hidden" style="height:220px;">
                <img src="{{ Storage::url($post->cover_image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            </div>
            @else
            <div style="height:220px;background:linear-gradient(135deg,#1a3a6b,#2a5080);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5rem;">
                <span class="text-5xl">✍️</span>
                <span style="color:#c8a84b;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;">{{ $post->category }}</span>
            </div>
            @endif
            <div class="p-6">
                <div class="flex items-center gap-2 mb-3">
                    <span style="background:#fef3d0;color:#a6892f;font-size:0.65rem;font-weight:900;letter-spacing:0.08em;text-transform:uppercase;padding:0.2rem 0.65rem;border-radius:100px;">{{ $post->category }}</span>
                    @if($post->published_at)<span class="text-gray-400 text-xs">{{ $post->published_at->format('d M Y') }}</span>@endif
                </div>
                <h3 style="font-family:'Playfair Display',serif;font-size:1.15rem;color:#0f2544;font-weight:700;line-height:1.4;" class="mb-3">{{ $post->title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">{{ $post->excerpt }}</p>
                <div style="height:1px;background:linear-gradient(90deg,#c8a84b,transparent);margin:1rem 0;"></div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs">By <strong style="color:#0f2544;">{{ $post->author }}</strong></span>
                    <a href="{{ route('blog.show', $post) }}" style="color:#c8a84b;font-weight:700;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;">Read →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-12 text-center">{{ $posts->links() }}</div>
    @else
    <div class="text-center py-24">
        <p class="text-6xl mb-4">✍️</p>
        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#0f2544;">No posts yet</h3>
        <p class="text-gray-400 mt-2">Check back soon for devotionals and updates!</p>
    </div>
    @endif
</div>
</div>
@endsection
