<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — RCCG Rehoboth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{navy:{DEFAULT:'#0f2544',light:'#1a3a6b'},gold:{DEFAULT:'#c8a84b',light:'#e2c46e',dark:'#a6892f'}}}}}</script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Lato', sans-serif; background: #f1f5f9; }
        h1,h2,h3 { font-family: 'Playfair Display', serif; }

        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1rem; border-radius: 8px;
            color: rgba(255,255,255,0.55); font-size: 0.82rem; font-weight: 600;
            letter-spacing: 0.03em; transition: all 0.2s; cursor: pointer;
        }
        .sidebar-link:hover { background: rgba(255,255,255,0.08); color: white; }
        .sidebar-link.active { background: linear-gradient(135deg,#c8a84b,#e2c46e); color: #0f2544 !important; font-weight: 700; box-shadow: 0 4px 15px rgba(200,168,75,0.3); }
        .sidebar-link.active svg { color: #0f2544; }

        .form-label { display: block; font-size: 0.78rem; font-weight: 700; color: #374151; margin-bottom: 0.35rem; letter-spacing: 0.03em; text-transform: uppercase; }
        .form-input { width: 100%; border: 1.5px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.85rem; font-size: 0.875rem; transition: all 0.2s; outline: none; background: white; }
        .form-input:focus { border-color: #c8a84b; box-shadow: 0 0 0 3px rgba(200,168,75,0.12); }
        .form-textarea { width: 100%; border: 1.5px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.85rem; font-size: 0.875rem; resize: vertical; outline: none; transition: all 0.2s; }
        .form-textarea:focus { border-color: #c8a84b; box-shadow: 0 0 0 3px rgba(200,168,75,0.12); }

        .btn-primary { background: #0f2544; color: white; font-weight: 700; padding: 0.6rem 1.4rem; border-radius: 8px; font-size: 0.82rem; transition: all 0.2s; display: inline-block; }
        .btn-primary:hover { background: #1a3a6b; transform: translateY(-1px); }
        .btn-gold { background: linear-gradient(135deg,#c8a84b,#e2c46e); color: #0f2544; font-weight: 800; padding: 0.6rem 1.4rem; border-radius: 8px; font-size: 0.82rem; transition: all 0.2s; display: inline-block; box-shadow: 0 2px 10px rgba(200,168,75,0.25); }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(200,168,75,0.35); }
        .btn-danger { background: #fef2f2; color: #dc2626; font-weight: 700; padding: 0.45rem 0.85rem; border-radius: 6px; font-size: 0.75rem; border: 1px solid #fecaca; transition: all 0.2s; }
        .btn-danger:hover { background: #dc2626; color: white; }

        .table-th { padding: 0.75rem 1rem; text-align: left; font-size: 0.7rem; font-weight: 800; color: #6b7280; text-transform: uppercase; letter-spacing: 0.08em; }
        .table-td { padding: 0.85rem 1rem; font-size: 0.85rem; color: #374151; vertical-align: middle; }
        .badge-green { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.65rem; font-size: 0.7rem; font-weight: 700; background: #dcfce7; color: #15803d; border-radius: 100px; }
        .badge-green::before { content: '●'; font-size: 0.5rem; }
        .badge-gray { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.65rem; font-size: 0.7rem; font-weight: 700; background: #f3f4f6; color: #6b7280; border-radius: 100px; }
        .badge-gray::before { content: '●'; font-size: 0.5rem; }

        .stat-card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.04); transition: all 0.2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
    </style>
    @stack('styles')
</head>
<body>

<div class="flex h-screen overflow-hidden">

    <!-- ── SIDEBAR ─────────────────────────────────────────── -->
    <aside style="width:260px; background:linear-gradient(180deg,#0a1c38,#0f2544); flex-shrink:0;" class="flex flex-col overflow-y-auto">

        <!-- Logo -->
        <div class="px-5 py-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div style="width:36px; height:36px; background:linear-gradient(135deg,#c8a84b,#e2c46e); border-radius:8px;" class="flex items-center justify-center flex-shrink-0">
                    <span style="font-family:'Playfair Display',serif; font-weight:700; color:#0f2544; font-size:1.1rem;">R</span>
                </div>
                <div>
                    <p class="text-white font-black text-xs tracking-wide">RCCG REHOBOTH</p>
                    <p style="color:#c8a84b; font-size:0.6rem; letter-spacing:0.12em;" class="uppercase">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-5 space-y-1">
            <p style="color:rgba(255,255,255,0.2); font-size:0.6rem; font-weight:800; letter-spacing:0.15em; text-transform:uppercase;" class="px-3 mb-2">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p style="color:rgba(255,255,255,0.2); font-size:0.6rem; font-weight:800; letter-spacing:0.15em; text-transform:uppercase;" class="px-3 pt-4 mb-2">Content</p>

            <a href="{{ route('admin.sermons.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.sermons*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 9a3 3 0 010 6m-3.536-6.536a5 5 0 000 7.072"/></svg>
                Sermons
            </a>
            <a href="{{ route('admin.events.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.events*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Events
            </a>
            <a href="{{ route('admin.bulletins.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.bulletins*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Bulletins
            </a>
            <a href="{{ route('admin.gallery.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Gallery
            </a>
            <a href="{{ route('admin.blog.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Blog & Devotionals
            </a>
        </nav>

        <!-- Bottom -->
        <div class="px-3 py-4 border-t border-white/10 space-y-1">
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ── MAIN ────────────────────────────────────────────── -->
    <main class="flex-1 overflow-y-auto">

        <!-- Top bar -->
        <div style="background:white; border-bottom:1px solid #f1f5f9; position:sticky; top:0; z-index:40;" class="px-8 py-4 flex items-center justify-between shadow-sm">
            <div>
                <h1 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#0f2544; font-weight:700;">@yield('page-title', 'Dashboard')</h1>
                <p class="text-gray-400 text-xs mt-0.5">RCCG Rehoboth Admin Panel</p>
            </div>
            <div class="flex items-center gap-3">
                <div style="background:#fef3d0; border-radius:100px; padding:0.35rem 1rem;" class="flex items-center gap-2">
                    <div style="width:8px; height:8px; background:#c8a84b; border-radius:50%;"></div>
                    <span style="font-size:0.78rem; font-weight:700; color:#a6892f;">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>

        <!-- Flash messages -->
        @if(session('success'))
        <div style="margin:1.5rem 2rem 0; background:#dcfce7; border:1px solid #bbf7d0; border-radius:10px; padding:0.85rem 1.25rem;" class="flex items-center gap-3">
            <span class="text-green-600 text-lg">✅</span>
            <span style="font-size:0.85rem; font-weight:600; color:#15803d;">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div style="margin:1.5rem 2rem 0; background:#fef2f2; border:1px solid #fecaca; border-radius:10px; padding:0.85rem 1.25rem;" class="flex items-center gap-3">
            <span class="text-red-500 text-lg">❌</span>
            <span style="font-size:0.85rem; font-weight:600; color:#dc2626;">{{ session('error') }}</span>
        </div>
        @endif

        <div class="p-8">
            @yield('content')
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>
