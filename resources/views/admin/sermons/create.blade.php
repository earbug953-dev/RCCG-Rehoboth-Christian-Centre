@extends('layouts.admin')
@section('title', 'Upload Sermon')
@section('page-title', 'Upload New Sermon')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.sermons.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Sermon Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="e.g. The Grace of God">
                </div>
                <div>
                    <label class="form-label">Preacher <span class="text-red-500">*</span></label>
                    <input type="text" name="preacher" value="{{ old('preacher') }}" required class="form-input" placeholder="e.g. Pastor John Smith">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Scripture Reference</label>
                    <input type="text" name="scripture" value="{{ old('scripture') }}" class="form-input" placeholder="e.g. John 3:16">
                </div>
                <div>
                    <label class="form-label">Sermon Date <span class="text-red-500">*</span></label>
                    <input type="date" name="sermon_date" value="{{ old('sermon_date') }}" required class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-textarea" placeholder="Brief description of the sermon...">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="form-label">Media Type <span class="text-red-500">*</span></label>
                <select name="file_type" id="file_type" class="form-input" onchange="toggleMediaInput(this.value)">
                    <option value="audio"   {{ old('file_type') == 'audio'   ? 'selected' : '' }}>Audio Upload (MP3/WAV)</option>
                    <option value="video"   {{ old('file_type') == 'video'   ? 'selected' : '' }}>Video Upload (MP4)</option>
                    <option value="youtube" {{ old('file_type') == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
                </select>
            </div>

            <div id="file_upload_field">
                <label class="form-label">Upload File</label>
                <input type="file" name="sermon_file" accept=".mp3,.mp4,.wav,.ogg,.webm" class="form-input py-1.5">
                <p class="text-xs text-gray-400 mt-1">Max: 500MB · Accepted: MP3, MP4, WAV, OGG, WEBM</p>
            </div>

            <div id="youtube_field" class="hidden">
                <label class="form-label">YouTube URL</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" class="form-input" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <div>
                <label class="form-label">Thumbnail Image</label>
                <input type="file" name="thumbnail" accept="image/*" class="form-input py-1.5">
                <p class="text-xs text-gray-400 mt-1">Optional · Max: 2MB</p>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published') ? 'checked' : '' }} class="rounded">
                <label for="is_published" class="text-sm font-medium text-gray-700">Publish immediately</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold">Upload Sermon</button>
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
toggleMediaInput('{{ old('file_type', 'audio') }}');
</script>
@endpush
@endsection
