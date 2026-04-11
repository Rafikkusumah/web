@extends('layouts.admin')

@section('page-title', 'Quotation Detail')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $quotation->quotation_number }}</h2>
                <p class="text-gray-600 mt-1">{{ $quotation->company_name }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.quotations.pdf', $quotation) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 whitespace-nowrap">
                    Download PDF
                </a>
                <a href="{{ route('admin.invoices.from-quotation', $quotation) }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 whitespace-nowrap">
                    Create Invoice
                </a>
                <a href="{{ route('admin.invoice2.from-quotation', $quotation) }}" class="px-4 py-2 rounded-lg whitespace-nowrap hover:opacity-90" style="background-color: #1e3a5f; color: white;">
                    Invoice2 (Stages)
                </a>
                <a href="{{ route('admin.quotations.edit', $quotation) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 whitespace-nowrap">
                    Edit
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Quotation Information</h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-gray-600">Date:</dt>
                        <dd class="font-medium">{{ $quotation->quotation_date->format('F d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Valid Until:</dt>
                        <dd class="font-medium">{{ $quotation->valid_until->format('F d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Salesperson:</dt>
                        <dd class="font-medium">{{ $quotation->salesperson }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Client Information</h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-gray-600">Company:</dt>
                        <dd class="font-medium">{{ $quotation->company_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Address:</dt>
                        <dd class="font-medium">{{ $quotation->address }}, {{ $quotation->city }} {{ $quotation->zip_code }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Project Description</h3>
            <p class="text-gray-700">{{ $quotation->project_description }}</p>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Line Items</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Unit</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($quotation->items as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->item_name }}</td>
                        <td class="px-4 py-3">{{ $item->description ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->unit }}</td>
                        <td class="px-4 py-3 text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="border-t pt-4">
            <div class="flex justify-end">
                <div class="w-64">
                    <div class="flex justify-between py-2">
                        <span>Subtotal:</span>
                        <span class="font-medium">Rp {{ number_format($quotation->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if($quotation->use_vat)
                    <div class="flex justify-between py-2">
                        <span>VAT ({{ $quotation->vat_percentage }}%):</span>
                        <span class="font-medium">Rp {{ number_format($quotation->vat_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between py-2 border-t font-bold text-lg">
                        <span>Total:</span>
                        <span>Rp {{ number_format($quotation->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        @if($quotation->notes || $quotation->terms)
        <div class="grid grid-cols-2 gap-6 mt-6 border-t pt-6">
            @if($quotation->notes)
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Notes</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $quotation->notes }}</p>
            </div>
            @endif
            @if($quotation->terms)
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Terms & Conditions</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $quotation->terms }}</p>
            </div>
            @endif
        </div>
        @endif
        
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('admin.quotations.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
