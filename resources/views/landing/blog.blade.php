@extends('layouts.landing')

@section('title', 'Blog')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog & News</h1>
        <p class="text-xl">Informasi dan artikel terbaru dari kami</p>
    </div>
</section>

<!-- Blog Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($blogs->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            <a href="{{ route('blog.detail', $blog->slug) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-56 bg-gray-200">
                    @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                    <p class="text-sm text-gray-500 mb-3">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $blog->published_at->format('M d, Y') }}
                    </p>
                    <p class="text-gray-700 line-clamp-3">{{ Str::limit($blog->excerpt, 120) }}</p>
                    <p class="text-red-600 mt-4 font-semibold">Read More →</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-500 text-lg">No blog posts available yet.</p>
        </div>
        @endif
    </div>
</section>
@endsection
