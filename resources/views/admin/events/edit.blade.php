@extends('layouts.admin')
@section('title','Edit Event') @section('page-title','Edit Event')
@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-5">
    @csrf @method('PUT')
    <div>
        <label class="form-label">Event Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="form-input">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-textarea">{{ old('description', $event->description) }}</textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Event Date <span class="text-red-500">*</span></label>
            <input type="date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required class="form-input">
        </div>
        <div>
            <label class="form-label">Event Time</label>
            <input type="time" name="event_time" value="{{ old('event_time', $event->event_time) }}" class="form-input">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date', optional($event->end_date)->format('Y-m-d')) }}" class="form-input">
        </div>
        <div>
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" class="form-input">
        </div>
    </div>
    <div>
        <label class="form-label">Replace Flyer</label>
        @if($event->flyer)
        <img src="{{ Storage::url($event->flyer) }}" class="w-24 h-16 object-cover rounded mb-2">
        @endif
        <input type="file" name="flyer" accept="image/*" class="form-input py-1.5">
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }} class="rounded">
        <label class="text-sm font-medium text-gray-700">Published</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Save Changes</button>
        <a href="{{ route('admin.events.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
