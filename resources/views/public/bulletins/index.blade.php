@extends('layouts.app')
@section('title', 'Bulletins — RCCG Rehoboth')
@section('content')

<div style="background:linear-gradient(160deg,#0a1c38,#0f2544);" class="py-20 text-center relative overflow-hidden">
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 50% 100%,rgba(200,168,75,0.1),transparent 70%);"></div>
    <div class="relative">
        <div class="section-label justify-center" style="color:#c8a84b;">Weekly</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:3rem;color:white;font-weight:700;">Church Bulletins</h1>
        <p class="text-white/50 mt-3 text-sm">Download our weekly PDF newsletters and bulletins</p>
    </div>
</div>

<div style="background:#fdf8f0;" class="py-16">
<div class="max-w-3xl mx-auto px-6">
    @if($bulletins->count())
    <div class="space-y-4">
        @foreach($bulletins as $i => $bulletin)
        <div class="fade-in" style="background:white;border-radius:12px;padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 15px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.04);transition:all 0.2s;" onmouseover="this.style.transform='translateX(4px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateX(0)';this.style.boxShadow='0 2px 15px rgba(0,0,0,0.05)';">
            <div class="flex items-center gap-4">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#fef3d0,#fde68a);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;">📄</div>
                <div>
                    <h3 style="font-weight:700;color:#0f2544;font-size:0.95rem;">{{ $bulletin->title }}</h3>
                    <p style="color:#c8a84b;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-top:0.2rem;">{{ $bulletin->bulletin_date->format('D, d F Y') }}</p>
                </div>
            </div>
            <a href="{{ Storage::url($bulletin->file_path) }}" target="_blank" class="btn-gold text-xs flex-shrink-0">
                ⬇ Download
            </a>
        </div>
        @endforeach
    </div>
    <div class="mt-10 text-center">{{ $bulletins->links() }}</div>
    @else
    <div class="text-center py-24">
        <p class="text-6xl mb-4">📄</p>
        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#0f2544;">No bulletins uploaded yet</h3>
        <p class="text-gray-400 mt-2">Check back after Sunday service!</p>
    </div>
    @endif
</div>
</div>
@endsection
