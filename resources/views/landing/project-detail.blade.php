@extends('layouts.landing')

@section('title', $project->company_name)

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Project Detail</h1>
        <p class="text-xl">{{ $project->company_name }}</p>
    </div>
</section>

<!-- Project Detail Section -->
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Cover Image -->
            <div class="h-96 bg-gray-200">
                @if($project->cover_image)
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover">
                @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                @endif
            </div>
            
            <div class="p-8">
                <!-- Project Info -->
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $project->company_name }}</h2>
                    <p class="text-gray-600 text-lg flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $project->location }}
                    </p>
                </div>
                
                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Project Description</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
                </div>
                
                <!-- Additional Media -->
                @if($project->media->count() > 0)
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Project Gallery</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($project->media as $media)
                        <div class="rounded-lg overflow-hidden shadow-md">
                            @if($media->file_type === 'image')
                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Project Media" class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-800 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                </svg>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Back Button -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('our-projects') }}" class="inline-block text-red-600 hover:text-red-700 font-semibold">
                        ← Back to All Projects
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Interested in Our Services?</h2>
        <p class="text-xl mb-8">Hubungi kami untuk konsultasi gratis dan penawaran terbaik</p>
        <a href="{{ route('contact') }}" class="inline-block bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">Contact Us →</a>
    </div>
</section>
@endsection
