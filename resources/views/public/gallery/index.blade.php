@extends('layouts.app')
@section('title', 'Gallery — RCCG Rehoboth')

@section('content')

<div class="bg-navy py-14 text-center">
    <p class="section-subtitle text-gold">Memories</p>
    <h1 class="text-4xl font-bold text-white">Photo Gallery</h1>
    <p class="text-white/60 mt-2 text-sm">Moments from our church family</p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
    @if($albums->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($albums as $album)
        <div class="card group cursor-pointer" onclick="openAlbum({{ $album->id }})">
            @if($album->cover_photo)
            <img src="{{ Storage::url($album->cover_photo) }}"
                 class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
            @else
            <div class="w-full h-52 bg-gradient-to-br from-navy to-blue-900 flex items-center justify-center">
                <span class="text-5xl">🖼️</span>
            </div>
            @endif
            <div class="p-5 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-navy text-lg leading-snug">{{ $album->title }}</h3>
                    @if($album->description)
                    <p class="text-gray-500 text-sm mt-1 line-clamp-1">{{ $album->description }}</p>
                    @endif
                </div>
                <span class="text-gold font-bold text-sm ml-4 flex-shrink-0">{{ $album->photos_count }} 📷</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $albums->links() }}</div>
    @else
    <div class="text-center py-20 text-gray-400">
        <p class="text-5xl mb-4">🖼️</p>
        <p class="text-lg font-semibold">No photos uploaded yet.</p>
    </div>
    @endif
</div>

{{-- Album Modal --}}
<div id="album-modal" class="fixed inset-0 bg-black/95 z-50 hidden flex-col">
    <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
        <h2 id="modal-title" class="text-white font-bold text-lg"></h2>
        <button onclick="closeAlbum()" class="text-white/60 hover:text-white text-3xl w-10 h-10 flex items-center justify-center">&times;</button>
    </div>
    <div id="modal-loading" class="flex-1 flex items-center justify-center text-white/40"><p>Loading photos...</p></div>
    <div id="modal-photos" class="flex-1 overflow-y-auto p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 hidden"></div>
</div>

{{-- Full Photo Viewer --}}
<div id="photo-viewer" class="fixed inset-0 bg-black/98 z-[60] hidden items-center justify-center flex-col px-4">
    <button onclick="closeViewer()" class="absolute top-4 right-4 text-white/60 hover:text-white text-3xl">&times;</button>
    <img id="viewer-img" src="" class="max-h-[85vh] max-w-[90vw] object-contain rounded shadow-2xl">
    <p id="viewer-caption" class="text-white/60 text-sm mt-3 text-center"></p>
</div>

@push('scripts')
<script>
function openAlbum(id) {
    const modal = document.getElementById('album-modal');
    modal.classList.remove('hidden'); modal.classList.add('flex');
    document.getElementById('modal-loading').classList.remove('hidden');
    document.getElementById('modal-photos').classList.add('hidden');
    document.getElementById('modal-photos').innerHTML = '';

    fetch('/gallery-photos/' + id)
        .then(r => r.json())
        .then(data => {
            document.getElementById('modal-title').textContent = data.title;
            const grid = document.getElementById('modal-photos');
            if (!data.photos.length) {
                grid.innerHTML = '<p class="text-white/40 col-span-full text-center">No photos in this album yet.</p>';
            } else {
                data.photos.forEach(p => {
                    const d = document.createElement('div');
                    d.className = 'cursor-pointer group';
                    d.innerHTML = '<img src="' + p.url + '" class="w-full h-36 object-cover rounded-lg group-hover:opacity-80 transition-opacity" onclick="viewPhoto(\'' + p.url.replace(/'/g,"\\'") + '\',\'' + (p.caption||'').replace(/'/g,"\\'") + '\')">' +
                        (p.caption ? '<p class="text-white/50 text-xs mt-1 truncate">' + p.caption + '</p>' : '');
                    grid.appendChild(d);
                });
            }
            document.getElementById('modal-loading').classList.add('hidden');
            grid.classList.remove('hidden');
        })
        .catch(() => { document.getElementById('modal-loading').innerHTML = '<p class="text-red-400">Could not load photos.</p>'; });
}
function closeAlbum() {
    document.getElementById('album-modal').classList.add('hidden');
    document.getElementById('album-modal').classList.remove('flex');
}
function viewPhoto(url, caption) {
    document.getElementById('viewer-img').src = url;
    document.getElementById('viewer-caption').textContent = caption;
    const v = document.getElementById('photo-viewer');
    v.classList.remove('hidden'); v.classList.add('flex');
}
function closeViewer() {
    const v = document.getElementById('photo-viewer');
    v.classList.add('hidden'); v.classList.remove('flex');
}
document.addEventListener('keydown', e => { if(e.key==='Escape'){closeViewer();closeAlbum();} });
</script>
@endpush
@endsection
