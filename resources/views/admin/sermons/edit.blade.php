@extends('layouts.admin')
@section('title', 'Edit Sermon')
@section('page-title', 'Edit Sermon')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.sermons.update', $sermon) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Sermon Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $sermon->title) }}" required class="form-input">
                </div>
                <div>
                    <label class="form-label">Preacher <span class="text-red-500">*</span></label>
                    <input type="text" name="preacher" value="{{ old('preacher', $sermon->preacher) }}" required class="form-input">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Scripture Reference</label>
                    <input type="text" name="scripture" value="{{ old('scripture', $sermon->scripture) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Sermon Date <span class="text-red-500">*</span></label>
                    <input type="date" name="sermon_date" value="{{ old('sermon_date', $sermon->sermon_date->format('Y-m-d')) }}" required class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-textarea">{{ old('description', $sermon->description) }}</textarea>
            </div>

            <div>
                <label class="form-label">Media Type <span class="text-red-500">*</span></label>
                <select name="file_type" id="file_type" class="form-input" onchange="toggleMediaInput(this.value)">
                    <option value="audio"   {{ old('file_type', $sermon->file_type) == 'audio'   ? 'selected' : '' }}>Audio (MP3/WAV)</option>
                    <option value="video"   {{ old('file_type', $sermon->file_type) == 'video'   ? 'selected' : '' }}>Video (MP4)</option>
                    <option value="youtube" {{ old('file_type', $sermon->file_type) == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
                </select>
            </div>

            <div id="file_upload_field">
                <label class="form-label">Replace File <span class="text-gray-400 font-normal">(leave blank to keep existing)</span></label>
                @if($sermon->file_path)
                <p class="text-xs text-gray-400 mb-1">Current: {{ basename($sermon->file_path) }}</p>
                @endif
                <input type="file" name="sermon_file" accept=".mp3,.mp4,.wav,.ogg,.webm" class="form-input py-1.5">
            </div>

            <div id="youtube_field" class="hidden">
                <label class="form-label">YouTube URL</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $sermon->youtube_url) }}" class="form-input">
            </div>

            <div>
                <label class="form-label">Replace Thumbnail</label>
                @if($sermon->thumbnail)
                <img src="{{ Storage::url($sermon->thumbnail) }}" class="w-24 h-16 object-cover rounded mb-2">
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="form-input py-1.5">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published', $sermon->is_published) ? 'checked' : '' }} class="rounded">
                <label for="is_published" class="text-sm font-medium text-gray-700">Published</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold">Save Changes</button>
                <a href="{{ route('admin.sermons.index') }}" class="btn-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleMediaInput(type) {
    document.getElementById('file_upload_field').classList.toggle('hidden', type === 'youtube');
    document.getElementById('youtube_field').classList.toggle('hidden', type !== 'youtube');
}
toggleMediaInput('{{ old('file_type', $sermon->file_type) }}');
</script>
@endpush
@endsection
