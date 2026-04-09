@extends('layouts.admin')

@section('page-title', 'Projects')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-semibold transition">
        + Add New Project
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($projects as $project)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="w-16 h-16 bg-gray-200 rounded">
                        @if($project->cover_image)
                        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->company_name }}" class="w-full h-full object-cover rounded">
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $project->company_name }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-500">{{ $project->location }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('admin.projects.show', $project) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    <a href="{{ route('admin.projects.edit', $project) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No projects found. Create your first project!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($projects->hasPages())
<div class="mt-6">
    {{ $projects->links() }}
</div>
@endif
@endsection
