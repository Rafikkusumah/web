@extends('layouts.admin')

@section('page-title', 'Blog Posts')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-semibold transition">
        + Add New Blog Post
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($blogs as $blog)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="w-16 h-16 bg-gray-200 rounded">
                        @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover rounded">
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $blog->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'N/A' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $blog->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $blog->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No blog posts found. Create your first blog post!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($blogs->hasPages())
<div class="mt-6">
    {{ $blogs->links() }}
</div>
@endif
@endsection
