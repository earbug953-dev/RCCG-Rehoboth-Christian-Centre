@extends('layouts.admin')
@section('title','Upload Bulletin') @section('page-title','Upload Bulletin / Newsletter')
@section('content')
<div class="max-w-lg">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
    <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
</div>
@endif
<form method="POST" action="{{ route('admin.bulletins.store') }}" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <div>
        <label class="form-label">Bulletin Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="e.g. Sunday Bulletin – 14 April 2024">
    </div>
    <div>
        <label class="form-label">Bulletin Date <span class="text-red-500">*</span></label>
        <input type="date" name="bulletin_date" value="{{ old('bulletin_date') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label">PDF File <span class="text-red-500">*</span></label>
        <input type="file" name="bulletin_file" accept=".pdf" required class="form-input py-1.5">
        <p class="text-xs text-gray-400 mt-1">PDF only · Max: 20MB</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" id="pub" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded">
        <label for="pub" class="text-sm font-medium text-gray-700">Publish immediately</label>
    </div>
    <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-gold">Upload Bulletin</button>
        <a href="{{ route('admin.bulletins.index') }}" class="btn-primary">Cancel</a>
    </div>
</form>
</div>
</div>
@endsection
