{{-- resources/views/admin/bulletins/index.blade.php --}}
@extends('layouts.admin')
@section('title','Bulletins') @section('page-title','Bulletins & Newsletters')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $bulletins->total() }} bulletin(s)</p>
    <a href="{{ route('admin.bulletins.create') }}" class="btn-gold">+ Upload Bulletin</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
            <tr>
                <th class="table-th">Title</th><th class="table-th">Date</th>
                <th class="table-th">Status</th><th class="table-th">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($bulletins as $bulletin)
            <tr class="hover:bg-gray-50">
                <td class="table-td font-medium">{{ $bulletin->title }}</td>
                <td class="table-td">{{ $bulletin->bulletin_date->format('d M Y') }}</td>
                <td class="table-td">
                    @if($bulletin->is_published)<span class="badge-green">Published</span>
                    @else<span class="badge-gray">Draft</span>@endif
                </td>
                <td class="table-td flex gap-2">
                    <a href="{{ Storage::url($bulletin->file_path) }}" target="_blank"
                       class="bg-green-600 text-white text-xs px-3 py-1.5 rounded hover:bg-green-700">View PDF</a>
                    <form method="POST" action="{{ route('admin.bulletins.destroy', $bulletin) }}" onsubmit="return confirm('Delete this bulletin?')">
                        @csrf @method('DELETE')
                        <button class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="table-td text-center text-gray-400 py-8">No bulletins uploaded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $bulletins->links() }}</div>
@endsection
