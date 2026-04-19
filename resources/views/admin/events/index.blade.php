{{-- index.blade.php --}}
@extends('layouts.admin')
@section('title','Events') @section('page-title','Events')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $events->total() }} event(s)</p>
    <a href="{{ route('admin.events.create') }}" class="btn-gold">+ New Event</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
            <tr>
                <th class="table-th">Title</th><th class="table-th">Date</th>
                <th class="table-th">Location</th><th class="table-th">Status</th><th class="table-th">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($events as $event)
            <tr class="hover:bg-gray-50">
                <td class="table-td font-medium">{{ $event->title }}</td>
                <td class="table-td">{{ $event->event_date->format('d M Y') }}</td>
                <td class="table-td">{{ $event->location ?? '—' }}</td>
                <td class="table-td">
                    @if($event->is_published)<span class="badge-green">Published</span>
                    @else<span class="badge-gray">Draft</span>@endif
                </td>
                <td class="table-td flex gap-2">
                    <a href="{{ route('admin.events.edit', $event) }}" class="bg-navy text-white text-xs px-3 py-1.5 rounded hover:bg-blue-900">Edit</a>
                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="table-td text-center text-gray-400 py-8">No events yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $events->links() }}</div>
@endsection
