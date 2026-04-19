<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Open Graph / Link Preview --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:title"       content="@yield('title', 'RCCG Rehoboth Christian Centre, Chorley')">
    <meta property="og:description" content="@yield('meta_description', 'A place of worship, fellowship and spiritual growth in Chorley, Lancashire. All are welcome.')">
    <meta property="og:image"       content="{{ asset('images/og-preview.jpeg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name"   content="RCCG Rehoboth Christian Centre">

    {{-- WhatsApp / Twitter --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('title', 'RCCG Rehoboth Christian Centre, Chorley')">
    <meta name="twitter:description" content="@yield('meta_description', 'A place of worship, fellowship and spiritual growth in Chorley, Lancashire.')">
    <meta name="twitter:image"       content="{{ asset('images/og-preview.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RCCG Rehoboth Christian Centre, Chorley')</title>
    <meta name="description" content="@yield('meta_description', 'Welcome to RCCG Rehoboth Christian Centre, Chorley.')">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy:  { DEFAULT: '#0f2544', light: '#1a3a6b', dark: '#081729' },
                        gold:  { DEFAULT: '#c8a84b', light: '#e2c46e', dark: '#a6892f' },
                        cream: { DEFAULT: '#fdf8f0' },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body: ['Lato', 'sans-serif'],
                    },
                    boxShadow: {
                        'glow': '0 0 40px rgba(200,168,75,0.15)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Lato', sans-serif; background: #fdf8f0; }
        h1,h2,h3,h4 { font-family: 'Playfair Display', serif; }

        /* Navbar */
        .nav-link {
            position: relative;
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            transition: color 0.2s;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: #c8a84b;
            transition: width 0.3s ease;
        }
        .nav-link:hover, .nav-link.active { color: #c8a84b; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Buttons */
        .btn-gold {
            background: linear-gradient(135deg, #c8a84b, #e2c46e);
            color: #0f2544;
            font-weight: 800;
            padding: 0.75rem 2rem;
            border-radius: 4px;
            display: inline-block;
            transition: all 0.3s;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-size: 0.8rem;
            box-shadow: 0 4px 15px rgba(200,168,75,0.3);
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(200,168,75,0.45);
        }
        .btn-outline {
            border: 2px solid #c8a84b;
            color: #c8a84b;
            font-weight: 800;
            padding: 0.7rem 2rem;
            border-radius: 4px;
            display: inline-block;
            transition: all 0.3s;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .btn-outline:hover {
            background: #c8a84b;
            color: #0f2544;
            transform: translateY(-2px);
        }
        .btn-outline-dark {
            border: 2px solid #0f2544;
            color: #0f2544;
            font-weight: 800;
            padding: 0.7rem 2rem;
            border-radius: 4px;
            display: inline-block;
            transition: all 0.3s;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .btn-outline-dark:hover { background: #0f2544; color: white; }

        /* Cards */
        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            transition: all 0.35s ease;
            border: 1px solid rgba(0,0,0,0.04);
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }

        /* Section labels */
        .section-label {
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #c8a84b;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .section-label::before, .section-label::after {
            content: '';
            height: 1px;
            width: 30px;
            background: #c8a84b;
        }
        .section-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #0f2544; line-height: 1.2; }

        /* Divider cross */
        .cross-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .cross-divider::before, .cross-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(200,168,75,0.4));
        }
        .cross-divider::after { background: linear-gradient(to left, transparent, rgba(200,168,75,0.4)); }

        /* Scroll animation */
        .fade-in { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* Tag pill */
        .tag { display: inline-block; padding: 0.2rem 0.75rem; border-radius: 100px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; }
    </style>
    @stack('styles')
</head>
<body>

<!-- ── TOP BAR ─────────────────────────────────────────────── -->
<div style="background:#c8a84b;" class="py-1.5 text-center">
    <p class="text-xs font-bold text-navy tracking-widest uppercase">
        ✝ Welcome to RCCG Rehoboth Christian Centre, Chorley ✝
    </p>
</div>

<!-- ── NAVIGATION ──────────────────────────────────────────── -->
<header id="navbar" class="sticky top-0 z-50 transition-all duration-300" style="background:rgba(15,37,68,0.97); backdrop-filter:blur(12px);">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.jpeg') }}"
                    alt="RCCG Rehoboth Logo"
                    class="h-12 w-auto object-contain">
                <div>
                    <p class="text-white font-black text-sm tracking-wide leading-none">RCCG REHOBOTH</p>
                    <p style="color:#c8a84b; font-size:0.65rem; letter-spacing:0.15em;" class="font-semibold uppercase mt-0.5">Christian Centre · Chorley</p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('sermons.index') }}" class="nav-link {{ request()->routeIs('sermons*') ? 'active' : '' }}">Sermons</a>
                <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events*') ? 'active' : '' }}">Events</a>
                <a href="{{ route('bulletins.index') }}" class="nav-link {{ request()->routeIs('bulletins*') ? 'active' : '' }}">Bulletins</a>
                <a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery*') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
            </nav>

            <!-- CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('sermons.index') }}" class="btn-gold text-xs">Watch Live</a>
            </div>

            <!-- Mobile toggle -->
            <button id="menu-toggle" class="lg:hidden text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-white/10 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block nav-link py-2">Home</a>
            <a href="{{ route('sermons.index') }}" class="block nav-link py-2">Sermons</a>
            <a href="{{ route('events.index') }}" class="block nav-link py-2">Events</a>
            <a href="{{ route('bulletins.index') }}" class="block nav-link py-2">Bulletins</a>
            <a href="{{ route('gallery.index') }}" class="block nav-link py-2">Gallery</a>
            <a href="{{ route('blog.index') }}" class="block nav-link py-2">Blog</a>
        </div>
    </div>
</header>

@if(session('success'))
<div class="bg-green-600 text-white text-sm text-center py-3 font-semibold">
    ✅ {{ session('success') }}
</div>
@endif

@yield('content')

<!-- ── FOOTER ───────────────────────────────────────────────── -->
<footer style="background:#0a1c38;">
    <!-- Top footer -->
    <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-10">
        <!-- Brand -->
        <div class="md:col-span-2">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background:linear-gradient(135deg,#c8a84b,#e2c46e);">
                    <span style="font-family:'Playfair Display',serif; font-weight:700; color:#0f2544;">R</span>
                </div>
                <div>
                    <p class="text-white font-black text-sm">RCCG REHOBOTH</p>
                    <p style="color:#c8a84b; font-size:0.65rem; letter-spacing:0.15em;" class="uppercase">Christian Centre · Chorley</p>
                </div>
            </div>
            <p class="text-white/50 text-sm leading-relaxed max-w-xs">
                A vibrant RCCG parish in Chorley, Lancashire — a place of worship, healing, fellowship and spiritual growth for all.
            </p>
            <p class="mt-5 text-white/30 text-xs">📍 Chorley, Lancashire, UK</p>
            <p class="text-white/30 text-xs mt-1">✉ info@rccgrehoboth.org</p>
        </div>

        <!-- Links -->
        <div>
            <h4 style="color:#c8a84b;" class="text-xs font-black uppercase tracking-widest mb-5">Quick Links</h4>
            <ul class="space-y-3 text-sm">
                @foreach([['Sermons','sermons.index'],['Events','events.index'],['Bulletins','bulletins.index'],['Gallery','gallery.index'],['Blog','blog.index']] as $link)
                <li><a href="{{ route($link[1]) }}" class="text-white/50 hover:text-white transition-colors flex items-center gap-2">
                    <span style="color:#c8a84b;">›</span> {{ $link[0] }}
                </a></li>
                @endforeach
            </ul>
        </div>

        <!-- Service times -->
        <div>
            <h4 style="color:#c8a84b;" class="text-xs font-black uppercase tracking-widest mb-5">Service Times</h4>
            <div class="space-y-3 text-sm text-white/50">
                <div>
                    <p class="text-white font-semibold text-xs">Sunday Service</p>
                    <p>10:00 AM – 12:30 PM</p>
                </div>
                <div>
                    <p class="text-white font-semibold text-xs">Midweek Service</p>
                    <p>Wednesday 6:30 PM</p>
                </div>
                <div>
                    <p class="text-white font-semibold text-xs">Prayer Meeting</p>
                    <p>Friday 7:00 PM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-white/25 text-xs">&copy; {{ date('Y') }} RCCG Rehoboth Christian Centre, Chorley. All rights reserved.</p>
            <a href="{{ route('admin.login') }}" class="text-white/15 hover:text-white/40 text-xs transition-colors">Staff Portal</a>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
    // Fade-in on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
</script>
@stack('scripts')
</body>
</html>
