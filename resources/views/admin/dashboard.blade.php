@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Projects</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalProjects }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Blog Posts</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalBlogs }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.5 1a.5.5 0 000 1h9a.5.5 0 000-1h-9zm0 3a.5.5 0 000 1h9a.5.5 0 000-1h-9zm0 3a.5.5 0 000 1h5a.5.5 0 000-1h-5z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Quotations</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalQuotations }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Invoices</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalInvoices }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Projects</h3>
        </div>
        <div class="p-6">
            @if($recentProjects->count() > 0)
            <ul class="space-y-4">
                @foreach($recentProjects as $project)
                <li class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded">
                        @if($project->cover_image)
                        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover rounded">
                        @else
                        <svg class="w-6 h-6 m-auto text-gray-400 mt-2.5 ml-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        @endif
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-900 font-medium">{{ $project->company_name }}</p>
                        <p class="text-gray-500 text-sm">{{ $project->location }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500 text-center py-4">No projects yet.</p>
            @endif
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Quotations</h3>
        </div>
        <div class="p-6">
            @if($recentQuotations->count() > 0)
            <ul class="space-y-4">
                @foreach($recentQuotations as $quotation)
                <li class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-900 font-medium">{{ $quotation->quotation_number }}</p>
                        <p class="text-gray-500 text-sm">{{ $quotation->company_name }}</p>
                    </div>
                    <span class="text-gray-700 font-semibold">Rp {{ number_format($quotation->total, 0, ',', '.') }}</span>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500 text-center py-4">No quotations yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
