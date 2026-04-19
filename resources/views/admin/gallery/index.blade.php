{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layouts.admin')
@section('title','Gallery') @section('page-title','Photo Gallery')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $albums->total() }} album(s)</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-gold">+ New Album</a>
</div>
<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
    @forelse($albums as $album)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($album->cover_photo)
        <img src="{{ Storage::url($album->cover_photo) }}" class="w-full h-40 object-cover">
        @else
        <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-300 text-4xl">🖼️</div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-navy text-sm">{{ $album->title }}</h3>
            <p class="text-gray-400 text-xs mt-1">{{ $album->photos_count }} photo(s)</p>
            <div class="flex items-center justify-between mt-3">
                @if($album->is_published)<span class="badge-green">Published</span>
                @else<span class="badge-gray">Draft</span>@endif
                <div class="flex gap-2">
                    <a href="{{ route('admin.gallery.edit', $album) }}" class="bg-navy text-white text-xs px-2 py-1 rounded hover:bg-blue-900">Edit</a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $album) }}" onsubmit="return confirm('Delete album and all photos?')">
                        @csrf @method('DELETE')
                        <button class="btn-danger">Del</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-gray-400 col-span-3 text-center py-10">No albums yet.</p>
    @endforelse
</div>
<div class="mt-4">{{ $albums->links() }}</div>
@endsection
