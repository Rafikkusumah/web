@extends('layouts.landing')

@section('title', $blog->title)

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #dc2626, #991b1b);" class="text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog Detail</h1>
        <p class="text-xl">{{ $blog->title }}</p>
    </div>
</section>

<!-- Blog Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($blog->featured_image)
            <div class="h-96">
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>
            @else
            <div class="h-64 bg-gray-200 flex items-center justify-center">
                <svg class="w-32 h-32 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
            </div>
            @endif
            
            <div class="p-8">
                <div class="flex items-center text-gray-500 mb-6">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $blog->published_at->format('F d, Y') }}</span>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $blog->title }}</h1>
                
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($blog->content)) !!}
                </div>
                
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <a href="{{ route('blog') }}" class="inline-block text-red-600 hover:text-red-700 font-semibold">
                        ← Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
