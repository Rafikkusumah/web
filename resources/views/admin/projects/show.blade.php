@extends('layouts.admin')

@section('page-title', 'Project Detail')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="h-64 bg-gray-200">
        @if($project->cover_image)
        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover">
        @endif
    </div>
    
    <div class="p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $project->company_name }}</h2>
                <p class="text-gray-600 mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    {{ $project->location }}
                </p>
            </div>
            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $project->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $project->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Description</h3>
            <p class="text-gray-700 whitespace-pre-line">{{ $project->description }}</p>
        </div>
        
        @if($project->media->count() > 0)
        <div>
            <h3 class="text-lg font-semibold mb-4">Additional Photos/Videos</h3>
            <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($project->media as $media)
                <div>
                    @if($media->file_type === 'image')
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="Media" class="w-full h-32 object-cover rounded">
                    @else
                    <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                Edit Project
            </a>
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
