@extends('layouts.admin')

@section('page-title', 'Edit Project')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $project->company_name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('company_name') border-red-500 @enderror">
                @error('company_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror">
                @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                @if($project->cover_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="Current Cover" class="w-48 h-32 object-cover rounded">
                </div>
                @endif
                <input type="file" id="cover_image" name="cover_image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cover_image') border-red-500 @enderror">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                @error('cover_image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
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
                Update Project
            </button>
        </div>
    </form>
</div>

<!-- Additional Media Section -->
<div class="bg-white rounded-lg shadow p-6 mt-6">
    <h3 class="text-lg font-semibold mb-4">Additional Photos/Videos</h3>
    
    <form action="{{ route('admin.projects.upload-media', $project) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="flex items-center space-x-3">
            <input type="file" id="files" name="files[]" accept="image/*,video/*" multiple required
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Upload
            </button>
        </div>
    </form>
    
    @if($project->media->count() > 0)
    <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($project->media as $media)
        <div class="relative group">
            @if($media->file_type === 'image')
            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Media" class="w-full h-32 object-cover rounded">
            @else
            <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                </svg>
            </div>
            @endif
            <form action="{{ route('admin.projects.delete-media', $media) }}" method="POST" class="absolute top-2 right-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white rounded-full p-1 hover:bg-red-700 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-gray-500 text-center py-4">No additional media files.</p>
    @endif
</div>
@endsection
