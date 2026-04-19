@extends('layouts.admin')
@section('title','New Album') @section('page-title','Create Gallery Album')
@section('content')
<div class="max-w-xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <div>
        <label class="form-label">Album Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="e.g. Easter Sunday 2024">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" rows="2" class="form-textarea">{{ old('description') }}</textarea>
    </div>
    <div>
        <label class="form-label">Cover Photo</label>
        <input type="file" name="cover_photo" accept="image/*" class="form-input py-1.5">
    </div>
    <div>
        <label class="form-label">Upload Photos</label>
        <input type="file" name="photos[]" accept="image/*" multiple class="form-input py-1.5">
        <p class="text-xs text-gray-400 mt-1">Select multiple images · Max 8MB each</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded">
        <label class="text-sm font-medium text-gray-700">Publish immediately</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Create Album</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
