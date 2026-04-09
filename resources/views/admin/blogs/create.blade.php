@extends('layouts.admin')

@section('page-title', 'Create Blog Post')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt <span class="text-red-500">*</span></label>
                <textarea id="excerpt" name="excerpt" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                <textarea id="content" name="content" rows="10" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image <span class="text-red-500">*</span></label>
                <input type="file" id="featured_image" name="featured_image" accept="image/*" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                @error('featured_image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_published" class="ml-2 block text-sm text-gray-700">
                    Publish immediately
                </label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Create Blog Post
            </button>
        </div>
    </form>
</div>
@endsection
