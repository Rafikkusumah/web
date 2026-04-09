@extends('layouts.admin')

@section('page-title', 'Create Project')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-6">
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('company_name') border-red-500 @enderror">
                @error('company_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror">
                @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image <span class="text-red-500">*</span></label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cover_image') border-red-500 @enderror">
                @error('cover_image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                    Active (show on landing page)
                </label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Create Project
            </button>
        </div>
    </form>
</div>
@endsection
