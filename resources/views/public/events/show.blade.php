@extends('layouts.app')
@section('title', $event->title . ' — RCCG Rehoboth')

@section('content')

<div class="bg-navy py-12 text-center">
    <p class="text-gold text-xs font-semibold uppercase tracking-widest mb-2">
        {{ $event->event_date->format('D, d F Y') }}
        @if($event->event_time) · {{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}@endif
    </p>
    <h1 class="text-3xl md:text-4xl font-bold text-white px-4">{{ $event->title }}</h1>
    @if($event->location)
    <p class="text-white/60 mt-2">📍 {{ $event->location }}</p>
    @endif
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        @if($event->flyer)
        <img src="{{ Storage::url($event->flyer) }}" class="w-full max-h-96 object-cover">
        @endif
        <div class="p-8">
            {{-- Meta --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-6 text-sm">
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Date</p>
                    <p class="font-bold text-navy">{{ $event->event_date->format('D, d F Y') }}</p>
                    @if($event->end_date && $event->end_date->ne($event->event_date))
                    <p class="text-gray-500 text-xs mt-0.5">Until {{ $event->end_date->format('d F Y') }}</p>
                    @endif
                </div>
                @if($event->event_time)
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Time</p>
                    <p class="font-bold text-navy">{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</p>
                </div>
                @endif
                @if($event->location)
                <div class="bg-gray-50 rounded-xl p-4 sm:col-span-2">
                    <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Location</p>
                    <p class="font-bold text-navy">{{ $event->location }}</p>
                </div>
                @endif
            </div>

            @if($event->description)
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($event->description)) !!}
            </div>
            @endif
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('events.index') }}" class="btn-outline">← Back to Events</a>
    </div>
</div>

@endsection
