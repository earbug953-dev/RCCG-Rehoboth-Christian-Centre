@extends('layouts.app')
@section('title', $blog->title . ' — RCCG Rehoboth')

@section('content')

{{-- Hero --}}
<div class="bg-navy py-14 text-center px-4">
    <div class="flex items-center justify-center gap-2 mb-4">
        <span class="text-xs bg-gold/30 text-gold font-semibold px-3 py-1 rounded-full">
            {{ $blog->category }}
        </span>
        @if($blog->published_at)
        <span class="text-white/40 text-xs">{{ $blog->published_at->format('d F Y') }}</span>
        @endif
    </div>
    <h1 class="text-3xl md:text-5xl font-bold text-white max-w-3xl mx-auto leading-tight">
        {{ $blog->title }}
    </h1>
    <p class="text-white/60 mt-4 text-sm">By <strong class="text-white/80">{{ $blog->author }}</strong></p>
</div>

{{-- Cover Image --}}
@if($blog->cover_image)
<div class="max-w-4xl mx-auto px-4 sm:px-6 -mt-8 relative z-10">
    <img src="{{ Storage::url($blog->cover_image) }}"
         class="w-full h-72 object-cover rounded-2xl shadow-xl">
</div>
@endif

{{-- Body --}}
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $blog->body !!}
        </div>
    </div>

    {{-- Related Posts --}}
    @if($related->count())
    <div class="mt-14">
        <h2 class="text-2xl font-bold text-navy mb-6">More Posts</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            @foreach($related as $post)
            <a href="{{ route('blog.show', $post) }}"
               class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition-shadow group">
                <span class="text-xs bg-gold/20 text-yellow-700 font-semibold px-2 py-0.5 rounded-full">
                    {{ $post->category }}
                </span>
                <h3 class="font-bold text-navy text-sm mt-2 group-hover:text-gold transition-colors leading-snug">
                    {{ $post->title }}
                </h3>
                <p class="text-gray-400 text-xs mt-1">{{ $post->author }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="text-center mt-10">
        <a href="{{ route('blog.index') }}" class="btn-outline">← Back to Blog</a>
    </div>
</div>

@endsection
