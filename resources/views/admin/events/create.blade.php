@extends('layouts.admin')
@section('title','New Event') @section('page-title','Create New Event')
@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <div>
        <label class="form-label">Event Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="e.g. Easter Sunday Service">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-textarea" placeholder="Details about the event...">{{ old('description') }}</textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Event Date <span class="text-red-500">*</span></label>
            <input type="date" name="event_date" value="{{ old('event_date') }}" required class="form-input">
        </div>
        <div>
            <label class="form-label">Event Time</label>
            <input type="time" name="event_time" value="{{ old('event_time') }}" class="form-input">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-input">
        </div>
        <div>
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="form-input" placeholder="e.g. Church Hall, Chorley">
        </div>
    </div>
    <div>
        <label class="form-label">Event Flyer / Image</label>
        <input type="file" name="flyer" accept="image/*" class="form-input py-1.5">
        <p class="text-xs text-gray-400 mt-1">Max: 4MB</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded">
        <label for="is_published" class="text-sm font-medium text-gray-700">Publish immediately</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Create Event</button>
        <a href="{{ route('admin.events.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
