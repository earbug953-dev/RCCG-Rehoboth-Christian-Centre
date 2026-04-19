@extends('layouts.admin')
@section('title','Edit Post') @section('page-title','Edit Blog Post')
@section('content')
<div class="max-w-3xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.blog.update', $blog) }}" enctype="multipart/form-data" class="space-y-5">
    @csrf @method('PUT')
    <div>
        <label class="form-label">Post Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="form-input">
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Author <span class="text-red-500">*</span></label>
            <input type="text" name="author" value="{{ old('author', $blog->author) }}" required class="form-input">
        </div>
        <div>
            <label class="form-label">Category</label>
            <select name="category" class="form-input">
                @foreach(['Devotional','Teaching','Announcement','Testimony','Prayer','General'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $blog->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="form-label">Excerpt</label>
        <textarea name="excerpt" rows="2" class="form-textarea">{{ old('excerpt', $blog->excerpt) }}</textarea>
    </div>
    <div>
        <label class="form-label">Body <span class="text-red-500">*</span></label>
        <textarea name="body" rows="14" class="form-textarea">{{ old('body', $blog->body) }}</textarea>
    </div>
    <div>
        <label class="form-label">Replace Cover Image</label>
        @if($blog->cover_image)
        <img src="{{ Storage::url($blog->cover_image) }}" class="w-32 h-20 object-cover rounded mb-2">
        @endif
        <input type="file" name="cover_image" accept="image/*" class="form-input py-1.5">
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" value="1"
               {{ old('is_published', $blog->is_published) ? 'checked' : '' }} class="rounded">
        <label class="text-sm font-medium text-gray-700">Published</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Save Changes</button>
        <a href="{{ route('admin.blog.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
