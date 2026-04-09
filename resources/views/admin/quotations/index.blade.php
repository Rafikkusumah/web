@extends('layouts.admin')

@section('page-title', 'Quotations')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.quotations.create') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-semibold transition">
        + Create New Quotation
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quotation #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($quotations as $quotation)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $quotation->quotation_number }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ $quotation->company_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $quotation->quotation_date->format('M d, Y') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($quotation->total, 0, ',', '.') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('admin.quotations.show', $quotation) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    <a href="{{ route('admin.quotations.edit', $quotation) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <a href="{{ route('admin.quotations.pdf', $quotation) }}" class="text-green-600 hover:text-green-900">PDF</a>
                    <a href="{{ route('admin.invoices.from-quotation', $quotation) }}" class="text-purple-600 hover:text-purple-900">Create Invoice</a>
                    <form action="{{ route('admin.quotations.destroy', $quotation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No quotations found. Create your first quotation!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($quotations->hasPages())
<div class="mt-6">
    {{ $quotations->links() }}
</div>
@endif
@endsection
