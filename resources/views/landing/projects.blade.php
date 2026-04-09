@extends('layouts.landing')

@section('title', 'Our Projects')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Projects</h1>
        <p class="text-xl">Portofolio proyek yang telah kami kerjakan</p>
    </div>
</section>

<!-- Projects Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <a href="{{ route('project.detail', $project->id) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-56 bg-gray-200">
                    @if($project->cover_image)
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->company_name }}</h3>
                    <p class="text-gray-600 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.5l-4.95-4.45a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $project->location }}
                    </p>
                    <p class="text-gray-700 line-clamp-3">{{ Str::limit($project->description, 120) }}</p>
                    <p class="text-red-600 mt-3 font-semibold">View Details →</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $projects->links() }}
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-500 text-lg">No projects available yet.</p>
        </div>
        @endif
    </div>
</section>
@endsection
