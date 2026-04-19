@extends('layouts.admin')
@section('title','Edit Album') @section('page-title','Edit Gallery Album')
@section('content')
<div class="max-w-xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.gallery.update', $gallery) }}" enctype="multipart/form-data" class="space-y-5">
    @csrf @method('PUT')
    <div>
        <label class="form-label">Album Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required class="form-input">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" rows="2" class="form-textarea">{{ old('description', $gallery->description) }}</textarea>
    </div>
    <div>
        <label class="form-label">Replace Cover Photo</label>
        @if($gallery->cover_photo)
            <img src="{{ Storage::url($gallery->cover_photo) }}" class="w-32 h-20 object-cover rounded mb-2">
        @endif
        <input type="file" name="cover_photo" accept="image/*" class="form-input py-1.5">
    </div>

    {{-- Existing Photos --}}
    @if($gallery->photos->count())
    <div>
        <label class="form-label">Current Photos ({{ $gallery->photos->count() }})</label>
        <div class="grid grid-cols-4 gap-2 mt-2">
            @foreach($gallery->photos as $photo)
            <div class="relative group">
                <img src="{{ Storage::url($photo->file_path) }}" class="w-full h-20 object-cover rounded">
                <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $photo->caption }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div>
        <label class="form-label">Add More Photos</label>
        <input type="file" name="photos[]" accept="image/*" multiple class="form-input py-1.5">
        <p class="text-xs text-gray-400 mt-1">Select multiple · Max 8MB each</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" value="1"
               {{ old('is_published', $gallery->is_published) ? 'checked' : '' }} class="rounded">
        <label class="text-sm font-medium text-gray-700">Published</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Save Changes</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
