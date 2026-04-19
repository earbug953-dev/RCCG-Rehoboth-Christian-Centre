@extends('layouts.app')
@section('title', $sermon->title . ' — RCCG Rehoboth')

@section('content')

<div class="bg-navy py-12 text-center">
    <p class="text-gold text-xs font-semibold uppercase tracking-widest mb-2">
        {{ $sermon->sermon_date->format('d F Y') }}
    </p>
    <h1 class="text-3xl md:text-4xl font-bold text-white px-4">{{ $sermon->title }}</h1>
    <p class="text-white/60 mt-2">{{ $sermon->preacher }}
        @if($sermon->scripture) · <em>{{ $sermon->scripture }}</em>@endif
    </p>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">

    {{-- Media Player --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        @if($sermon->isYoutube())
            <div class="aspect-video">
                <iframe src="{{ $sermon->getYoutubeEmbedUrl() }}"
                        class="w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>

        @elseif($sermon->file_path && $sermon->file_type === 'video')
            <video controls class="w-full rounded-t-2xl" preload="metadata">
                <source src="{{ Storage::url($sermon->file_path) }}" type="video/mp4">
                Your browser does not support video playback.
            </video>

        @elseif($sermon->file_path && $sermon->file_type === 'audio')
            <div class="p-8 flex flex-col items-center">
                @if($sermon->thumbnail)
                <img src="{{ Storage::url($sermon->thumbnail) }}"
                     class="w-48 h-48 object-cover rounded-full shadow-md mb-6">
                @else
                <div class="w-48 h-48 bg-navy rounded-full flex items-center justify-center mb-6 shadow-md">
                    <span class="text-6xl">🎤</span>
                </div>
                @endif
                <audio controls class="w-full max-w-lg mt-2">
                    <source src="{{ Storage::url($sermon->file_path) }}">
                    Your browser does not support audio playback.
                </audio>
            </div>

        @else
            <div class="p-10 text-center text-gray-400">
                <p class="text-4xl mb-3">🎤</p>
                <p>Media file not available.</p>
            </div>
        @endif

        {{-- Description --}}
        @if($sermon->description)
        <div class="p-6 border-t border-gray-100">
            <h2 class="font-bold text-navy mb-2 text-lg">About this Sermon</h2>
            <p class="text-gray-600 leading-relaxed">{{ $sermon->description }}</p>
        </div>
        @endif
    </div>

    <div class="text-center">
        <a href="{{ route('sermons.index') }}" class="btn-outline">← Back to Sermons</a>
    </div>
</div>

@endsection
