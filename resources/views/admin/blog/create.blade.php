@extends('layouts.admin')
@section('title','New Post') @section('page-title','Write New Blog Post')
@section('content')
<div class="max-w-3xl">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <div>
        <label class="form-label">Post Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title') }}" required class="form-input"
               placeholder="e.g. Walking in Faith Through Uncertain Times">
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="form-label">Author <span class="text-red-500">*</span></label>
            <input type="text" name="author" value="{{ old('author') }}" required class="form-input"
                   placeholder="e.g. Pastor John Smith">
        </div>
        <div>
            <label class="form-label">Category <span class="text-red-500">*</span></label>
            <select name="category" class="form-input">
                @foreach(['Devotional','Teaching','Announcement','Testimony','Prayer','General'] as $cat)
                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="form-label">Excerpt <span class="text-gray-400 font-normal">(short summary shown on listing)</span></label>
        <textarea name="excerpt" rows="2" class="form-textarea"
                  placeholder="A brief, compelling summary of the post...">{{ old('excerpt') }}</textarea>
    </div>
    <div>
        <label class="form-label">Body <span class="text-red-500">*</span></label>
        <textarea name="body" id="body" rows="14" class="form-textarea"
                  placeholder="Write your post here... HTML is supported.">{{ old('body') }}</textarea>
        <p class="text-xs text-gray-400 mt-1">HTML tags like &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;blockquote&gt; are supported.</p>
    </div>
    <div>
        <label class="form-label">Cover Image</label>
        <input type="file" name="cover_image" accept="image/*" class="form-input py-1.5">
        <p class="text-xs text-gray-400 mt-1">Max: 4MB</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" id="pub" value="1"
               {{ old('is_published') ? 'checked' : '' }} class="rounded">
        <label for="pub" class="text-sm font-medium text-gray-700">Publish immediately</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Publish Post</button>
        <a href="{{ route('admin.blog.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
