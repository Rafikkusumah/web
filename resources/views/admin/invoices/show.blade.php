@extends('layouts.admin')

@section('page-title', 'Invoice Detail')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $invoice->invoice_number }}</h2>
                <p class="text-gray-600 mt-1">{{ $invoice->company_name }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Download PDF
                </a>
                <a href="{{ route('admin.invoices.edit', $invoice) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                    Edit
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Invoice Information</h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-gray-600">Date:</dt>
                        <dd class="font-medium">{{ $invoice->invoice_date->format('F d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Due Date:</dt>
                        <dd class="font-medium">{{ $invoice->due_date->format('F d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Salesperson:</dt>
                        <dd class="font-medium">{{ $invoice->salesperson }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Client Information</h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-gray-600">Company:</dt>
                        <dd class="font-medium">{{ $invoice->company_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-600">Address:</dt>
                        <dd class="font-medium">{{ $invoice->address }}, {{ $invoice->city }} {{ $invoice->zip_code }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Project Description</h3>
            <p class="text-gray-700">{{ $invoice->project_description }}</p>
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
                    @foreach($invoice->items as $item)
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
                        <span class="font-medium">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if($invoice->use_vat)
                    <div class="flex justify-between py-2">
                        <span>VAT ({{ $invoice->vat_percentage }}%):</span>
                        <span class="font-medium">Rp {{ number_format($invoice->vat_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between py-2 border-t font-bold text-lg">
                        <span>Total:</span>
                        <span>Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        @if($invoice->notes || $invoice->terms)
        <div class="grid grid-cols-2 gap-6 mt-6 border-t pt-6">
            @if($invoice->notes)
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Notes</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $invoice->notes }}</p>
            </div>
            @endif
            @if($invoice->terms)
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Terms & Conditions</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $invoice->terms }}</p>
            </div>
            @endif
        </div>
        @endif
        
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('admin.invoices.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
