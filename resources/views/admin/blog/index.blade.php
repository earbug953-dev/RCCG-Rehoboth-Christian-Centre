@extends('layouts.admin')
@section('title','Blog') @section('page-title','Blog & Devotionals')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $posts->total() }} post(s)</p>
    <a href="{{ route('admin.blog.create') }}" class="btn-gold">+ New Post</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-100">
        <thead class="bg-gray-50">
            <tr>
                <th class="table-th">Title</th>
                <th class="table-th">Author</th>
                <th class="table-th">Category</th>
                <th class="table-th">Status</th>
                <th class="table-th">Date</th>
                <th class="table-th">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50">
                <td class="table-td font-medium max-w-xs truncate">{{ $post->title }}</td>
                <td class="table-td">{{ $post->author }}</td>
                <td class="table-td">
                    <span class="inline-block px-2 py-0.5 text-xs bg-blue-50 text-blue-700 rounded-full">
                        {{ $post->category }}
                    </span>
                </td>
                <td class="table-td">
                    @if($post->is_published)<span class="badge-green">Published</span>
                    @else<span class="badge-gray">Draft</span>@endif
                </td>
                <td class="table-td text-xs text-gray-400">
                    {{ $post->published_at?->format('d M Y') ?? '—' }}
                </td>
                <td class="table-td flex gap-2">
                    <a href="{{ route('admin.blog.edit', $post) }}"
                       class="bg-navy text-white text-xs px-3 py-1.5 rounded hover:bg-blue-900">Edit</a>
                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                          onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="table-td text-center text-gray-400 py-8">No posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection
