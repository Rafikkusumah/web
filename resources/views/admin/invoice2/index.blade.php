@extends('layouts.admin')

@section('page-title', 'Invoice2 - Payment Stages')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.invoice2.create') }}" class="bg-red-600 text-white hover:bg-red-700 px-4 py-2 rounded-lg font-semibold transition">
        + Create New Invoice2
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stages</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($invoices as $invoice)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $invoice->invoice_number }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ $invoice->company_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $invoice->invoice_date->format('M d, Y') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($invoice->total, 0, ',', '.') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $paidCount = $invoice->stages->where('stage_status', 'paid')->count();
                        $totalCount = $invoice->stages->count();
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $paidCount }}/{{ $totalCount }} paid
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('admin.invoice2.show', $invoice) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    <a href="{{ route('admin.invoice2.edit', $invoice) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <a href="{{ route('admin.invoice2.pdf', $invoice) }}" class="text-green-600 hover:text-green-900">PDF</a>
                    <form action="{{ route('admin.invoice2.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    No Invoice2 found. Create your first invoice with payment stages!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($invoices->hasPages())
<div class="mt-6">
    {{ $invoices->links() }}
</div>
@endif
@endsection
