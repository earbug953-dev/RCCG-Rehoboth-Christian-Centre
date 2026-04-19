{{-- resources/views/admin/sermons/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Sermons')
@section('page-title', 'Sermons')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $sermons->total() }} sermon(s) total</p>
    <a href="{{ route('admin.sermons.create') }}" class="btn-gold">+ Upload Sermon</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
            <tr>
                <th class="table-th">Title</th>
                <th class="table-th">Preacher</th>
                <th class="table-th">Date</th>
                <th class="table-th">Type</th>
                <th class="table-th">Status</th>
                <th class="table-th">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($sermons as $sermon)
            <tr class="hover:bg-gray-50">
                <td class="table-td font-medium">{{ $sermon->title }}</td>
                <td class="table-td">{{ $sermon->preacher }}</td>
                <td class="table-td">{{ $sermon->sermon_date->format('d M Y') }}</td>
                <td class="table-td capitalize">{{ $sermon->file_type }}</td>
                <td class="table-td">
                    @if($sermon->is_published)
                        <span class="badge-green">Published</span>
                    @else
                        <span class="badge-gray">Draft</span>
                    @endif
                </td>
                <td class="table-td flex gap-2">
                    <a href="{{ route('admin.sermons.edit', $sermon) }}"
                       class="bg-navy text-white text-xs px-3 py-1.5 rounded hover:bg-blue-900 transition">Edit</a>
                    <form method="POST" action="{{ route('admin.sermons.destroy', $sermon) }}"
                          onsubmit="return confirm('Delete this sermon?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="table-td text-gray-400 text-center py-8">No sermons yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $sermons->links() }}</div>
@endsection
