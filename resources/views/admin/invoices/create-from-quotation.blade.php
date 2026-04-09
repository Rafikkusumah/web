@extends('layouts.admin')

@section('page-title', 'Create Invoice from Quotation')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h3 class="text-lg font-semibold text-blue-900 mb-2">Creating Invoice from Quotation</h3>
        <p class="text-blue-700">
            <strong>Quotation:</strong> {{ $quotation->quotation_number }}<br>
            <strong>Company:</strong> {{ $quotation->company_name }}<br>
            <strong>Total:</strong> Rp {{ number_format($quotation->total, 0, ',', '.') }}
        </p>
        <p class="text-sm text-blue-600 mt-2">All data from quotation will be copied. You can adjust invoice number, dates, VAT, and notes.</p>
    </div>

    <form action="{{ route('admin.invoices.store-from-quotation', $quotation) }}" method="POST" id="invoice-form">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Number <span class="text-red-500">*</span></label>
                <input type="text" name="invoice_number" value="{{ old('invoice_number', 'INV-' . date('Ymd') . '-001') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('invoice_number') border-red-500 @enderror">
                <p class="text-sm text-gray-500 mt-1">Auto-generated, you can change it</p>
                @error('invoice_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Salesperson</label>
                <input type="text" value="{{ $quotation->salesperson }}" disabled
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                <input type="hidden" name="salesperson" value="{{ $quotation->salesperson }}">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Date <span class="text-red-500">*</span></label>
                <input type="date" name="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('invoice_date') border-red-500 @enderror">
                @error('invoice_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Due Date <span class="text-red-500">*</span></label>
                <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('due_date') border-red-500 @enderror">
                @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Client Information (Copied from Quotation)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" value="{{ $quotation->company_name }}" disabled
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <input type="text" value="{{ $quotation->city }}" disabled
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea rows="2" disabled
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">{{ $quotation->address }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
                    <input type="text" value="{{ $quotation->zip_code }}" disabled
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Project Description</h3>
            <textarea rows="3" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">{{ $quotation->project_description }}</textarea>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Line Items (Copied from Quotation)</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
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
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <div class="flex items-center mb-4">
                <input type="checkbox" id="use_vat" name="use_vat" value="1" {{ old('use_vat', $quotation->use_vat) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="use_vat" class="ml-2 block text-sm text-gray-700">
                    Apply VAT
                </label>
                <input type="number" name="vat_percentage" id="vat_percentage" value="{{ old('vat_percentage', $quotation->vat_percentage) }}" step="0.01" min="0" max="100"
                    class="ml-4 w-24 px-3 py-2 border border-gray-300 rounded text-sm"
                    {{ !old('use_vat', $quotation->use_vat) ? 'disabled' : '' }}>
                <span class="ml-2 text-sm text-gray-700">%</span>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between mb-2">
                    <span>Subtotal:</span>
                    <span class="font-medium">Rp {{ number_format($quotation->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-lg border-t pt-2">
                    <span>Total (without VAT):</span>
                    <span>Rp {{ number_format($quotation->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Notes & Terms</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('notes', $quotation->notes) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                    <textarea name="terms" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('terms', $quotation->terms) }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.quotations.show', $quotation) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                Create Invoice
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('use_vat').addEventListener('change', function() {
    document.getElementById('vat_percentage').disabled = !this.checked;
});
</script>
@endpush
@endsection
