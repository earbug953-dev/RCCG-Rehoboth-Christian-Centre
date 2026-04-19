@extends('layouts.app')
@section('title', 'RCCG Rehoboth Christian Centre, Chorley')

@section('content')

<!-- ── HERO ─────────────────────────────────────────────────── -->
<section style="background:linear-gradient(160deg, #0a1c38 0%, #0f2544 50%, #1a3a6b 100%); min-height:92vh;" class="relative flex items-center overflow-hidden">

    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(circle at 25% 50%, #c8a84b 0%, transparent 50%), radial-gradient(circle at 75% 20%, #c8a84b 0%, transparent 40%);"></div>

    <!-- Decorative cross -->
    <div class="absolute right-0 top-0 h-full w-1/2 flex items-center justify-end pr-16 opacity-5 pointer-events-none hidden lg:flex">
        <svg viewBox="0 0 200 300" width="320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="85" y="0" width="30" height="300" rx="4" fill="#c8a84b"/>
            <rect x="0" y="90" width="200" height="30" rx="4" fill="#c8a84b"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-16 items-center w-full">
        <div>
            <div class="section-label justify-start mb-6" style="color:#c8a84b;">
                <span style="height:1px; width:30px; background:#c8a84b; display:inline-block;"></span>
                Welcome to our church
                <span style="height:1px; width:30px; background:#c8a84b; display:inline-block;"></span>
            </div>

            <h1 style="font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); color:white; line-height:1.15; font-weight:700;" class="mb-6">
                RCCG Rehoboth<br>
                <em style="color:#c8a84b; font-style:italic;">Christian Centre</em>
            </h1>

            <p class="text-white/60 text-lg leading-relaxed mb-10 max-w-lg">
                A place of worship, healing and spiritual growth in the heart of Chorley, Lancashire. All are welcome in God's house.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('sermons.index') }}" class="btn-gold">Watch Sermons</a>
                <a href="{{ route('events.index') }}" class="btn-outline">Upcoming Events</a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6 mt-14 pt-10 border-t border-white/10">
                @foreach([['Every Sunday','10:00 AM Service'],['Midweek','Wednesday Prayer'],['All Welcome','Join Our Family']] as $s)
                <div>
                    <p style="color:#c8a84b; font-family:'Playfair Display',serif; font-size:1rem; font-weight:700;">{{ $s[0] }}</p>
                    <p class="text-white/40 text-xs mt-0.5">{{ $s[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Scripture card -->
        <div class="hidden lg:flex justify-end">
            <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(200,168,75,0.2); border-radius:12px; padding:3rem; max-width:420px; backdrop-filter:blur(10px);" class="shadow-glow">
                <div style="color:#c8a84b; font-size:4rem; line-height:1; font-family:'Playfair Display',serif; opacity:0.4;">"</div>
                <p style="font-family:'Playfair Display',serif; color:white; font-size:1.3rem; line-height:1.7; font-style:italic; margin-top:-1rem;">
                    For I know the plans I have for you, declares the Lord, plans to prosper you and not to harm you, plans to give you hope and a future.
                </p>
                <div class="mt-6 pt-5 border-t border-white/10">
                    <p style="color:#c8a84b; font-weight:700; font-size:0.8rem; letter-spacing:0.1em;">JEREMIAH 29:11</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-40">
        <p class="text-white text-xs tracking-widest uppercase">Scroll</p>
        <div style="width:1px; height:40px; background:linear-gradient(to bottom, white, transparent);"></div>
    </div>
</section>

<!-- ── WELCOME STRIP ─────────────────────────────────────────── -->
<div style="background:linear-gradient(90deg,#c8a84b,#e2c46e,#c8a84b);" class="py-4">
    <p class="text-center text-navy font-black text-xs tracking-widest uppercase">
        ✝ &nbsp; Serving God · Serving People · Transforming Lives &nbsp; ✝
    </p>
</div>

<!-- ── LATEST SERMON ─────────────────────────────────────────── -->
@if($latestSermon)
<section class="py-24" style="background:#fdf8f0;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 fade-in">
            <div class="section-label justify-center">Latest Message</div>
            <h2 class="section-title">Featured Sermon</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center fade-in">
            <!-- Thumbnail -->
            <div class="relative">
                @if($latestSermon->thumbnail)
                <img src="{{ Storage::url($latestSermon->thumbnail) }}"
                     class="w-full rounded-xl object-cover" style="height:380px; box-shadow:0 30px 60px rgba(15,37,68,0.2);">
                @else
                <div style="height:380px; background:linear-gradient(135deg,#0f2544,#1a3a6b); border-radius:12px; box-shadow:0 30px 60px rgba(15,37,68,0.2);" class="flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-7xl mb-4">🎤</div>
                        <p style="color:#c8a84b; font-family:'Playfair Display',serif; font-size:1.2rem;">{{ $latestSermon->title }}</p>
                    </div>
                </div>
                @endif
                <!-- Play badge -->
                <div class="absolute top-5 left-5">
                    <span style="background:linear-gradient(135deg,#c8a84b,#e2c46e); color:#0f2544;" class="tag font-black">
                        Latest Sermon
                    </span>
                </div>
            </div>

            <!-- Info -->
            <div class="lg:pl-6">
                <p style="color:#c8a84b; font-size:0.75rem; font-weight:900; letter-spacing:0.2em; text-transform:uppercase;" class="mb-3">
                    {{ $latestSermon->sermon_date->format('D, d F Y') }}
                </p>
                <h3 style="font-family:'Playfair Display',serif; font-size:2.2rem; color:#0f2544; line-height:1.25;" class="mb-4">
                    {{ $latestSermon->title }}
                </h3>

                <div style="height:3px; width:60px; background:linear-gradient(90deg,#c8a84b,#e2c46e); border-radius:2px;" class="mb-5"></div>

                <p class="text-gray-500 mb-2">
                    <span class="font-bold text-navy">Preacher:</span> {{ $latestSermon->preacher }}
                </p>
                @if($latestSermon->scripture)
                <p class="text-gray-500 mb-5">
                    <span class="font-bold text-navy">Scripture:</span> {{ $latestSermon->scripture }}
                </p>
                @endif
                @if($latestSermon->description)
                <p class="text-gray-500 leading-relaxed mb-8 text-sm">{{ Str::limit($latestSermon->description, 200) }}</p>
                @endif

                <a href="{{ route('sermons.show', $latestSermon) }}" class="btn-gold">
                    ▶ &nbsp; Listen / Watch Now
                </a>
                <a href="{{ route('sermons.index') }}" class="btn-outline-dark ml-4">All Sermons</a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ── UPCOMING EVENTS ──────────────────────────────────────── -->
@if($upcomingEvents->count())
<section class="py-24" style="background:white;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 fade-in">
            <div>
                <div class="section-label">What's Happening</div>
                <h2 class="section-title">Upcoming Events</h2>
            </div>
            <a href="{{ route('events.index') }}" class="btn-outline-dark mt-4 md:mt-0">See All Events</a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($upcomingEvents as $i => $event)
            <div class="card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                @if($event->flyer)
                <img src="{{ Storage::url($event->flyer) }}" class="w-full object-cover" style="height:200px;">
                @else
                <div style="height:200px; background:linear-gradient(135deg,#0f2544,#1a3a6b);" class="flex flex-col items-center justify-center">
                    <p style="color:#c8a84b; font-family:'Playfair Display',serif; font-size:3rem; font-weight:700; line-height:1;">{{ $event->event_date->format('d') }}</p>
                    <p class="text-white/60 text-sm font-semibold">{{ $event->event_date->format('M Y') }}</p>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span style="background:#fef3d0; color:#a6892f;" class="tag">📅 {{ $event->event_date->format('d M') }}</span>
                        @if($event->event_time)
                        <span style="background:#f0f4ff; color:#1a3a6b;" class="tag">{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>
                        @endif
                    </div>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.2rem; color:#0f2544; font-weight:700;" class="mb-2 leading-snug">
                        {{ $event->title }}
                    </h3>
                    @if($event->location)
                    <p class="text-gray-400 text-sm">📍 {{ $event->location }}</p>
                    @endif
                    <div style="height:1px; background:linear-gradient(90deg,#c8a84b,transparent);" class="my-4"></div>
                    <a href="{{ route('events.show', $event) }}" style="color:#c8a84b; font-weight:700; font-size:0.8rem; letter-spacing:0.05em; text-transform:uppercase;" class="hover:underline">
                        Find Out More →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ── BLOG POSTS ──────────────────────────────────────────── -->
@if($latestPosts->count())
<section class="py-24" style="background:#fdf8f0;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 fade-in">
            <div>
                <div class="section-label">Words of Life</div>
                <h2 class="section-title">Devotionals & Blog</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn-outline-dark mt-4 md:mt-0">Read All Posts</a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($latestPosts as $i => $post)
            <div class="card fade-in">
                @if($post->cover_image)
                <img src="{{ Storage::url($post->cover_image) }}" class="w-full object-cover" style="height:200px;">
                @else
                <div style="height:200px; background:linear-gradient(135deg,#1a3a6b,#2a5080);" class="flex items-center justify-center">
                    <span class="text-5xl">✍️</span>
                </div>
                @endif
                <div class="p-6">
                    <span style="background:#fef3d0; color:#a6892f;" class="tag mb-3 block w-fit">{{ $post->category }}</span>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; color:#0f2544; font-weight:700; line-height:1.4;" class="mb-3">
                        {{ $post->title }}
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">{{ $post->excerpt }}</p>
                    <div style="height:1px; background:linear-gradient(90deg,#c8a84b,transparent);" class="my-4"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-xs">By <strong class="text-navy">{{ $post->author }}</strong></span>
                        <a href="{{ route('blog.show', $post) }}" style="color:#c8a84b; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em;">Read →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ── QUICK LINKS ─────────────────────────────────────────── -->
<section style="background:linear-gradient(135deg,#0a1c38,#0f2544);" class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12 fade-in">
            <div class="section-label justify-center" style="color:#c8a84b;">Explore</div>
            <h2 style="font-family:'Playfair Display',serif; font-size:2rem; color:white;">Everything in One Place</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 fade-in">
            @foreach([
                ['🎤','Sermons','sermons.index','Listen to God\'s Word','Watch & download past messages'],
                ['📄','Bulletins','bulletins.index','Weekly Newsletters','Download our PDF bulletins'],
                ['🖼️','Gallery','gallery.index','Photo Gallery','Memories from our church family'],
                ['✍️','Blog','blog.index','Devotionals','Daily inspiration & teaching'],
            ] as $item)
            <a href="{{ route($item[2]) }}"
               style="border:1px solid rgba(200,168,75,0.2); border-radius:10px; padding:2rem; display:block; transition:all 0.3s;"
               onmouseover="this.style.background='rgba(200,168,75,0.1)'; this.style.borderColor='rgba(200,168,75,0.6)'; this.style.transform='translateY(-5px)';"
               onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(200,168,75,0.2)'; this.style.transform='translateY(0)';">
                <div class="text-4xl mb-4">{{ $item[0] }}</div>
                <h3 style="font-family:'Playfair Display',serif; color:white; font-size:1.2rem; font-weight:700;" class="mb-1">{{ $item[1] }}</h3>
                <p style="color:#c8a84b; font-size:0.7rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase;" class="mb-2">{{ $item[3] }}</p>
                <p class="text-white/40 text-xs">{{ $item[4] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
