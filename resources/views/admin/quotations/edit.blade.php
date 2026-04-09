@extends('layouts.admin')

@section('page-title', 'Edit Quotation')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.quotations.update', $quotation) }}" method="POST" id="quotation-form">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quotation Number <span class="text-red-500">*</span></label>
                <input type="text" name="quotation_number" value="{{ old('quotation_number', $quotation->quotation_number) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('quotation_number') border-red-500 @enderror">
                @error('quotation_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Salesperson <span class="text-red-500">*</span></label>
                <input type="text" name="salesperson" value="{{ old('salesperson', $quotation->salesperson) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('salesperson') border-red-500 @enderror">
                @error('salesperson')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quotation Date <span class="text-red-500">*</span></label>
                <input type="date" name="quotation_date" value="{{ old('quotation_date', $quotation->quotation_date->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('quotation_date') border-red-500 @enderror">
                @error('quotation_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Valid Until <span class="text-red-500">*</span></label>
                <input type="date" name="valid_until" value="{{ old('valid_until', $quotation->valid_until->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('valid_until') border-red-500 @enderror">
                @error('valid_until')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Client Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" value="{{ old('company_name', $quotation->company_name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $quotation->city) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('city') border-red-500 @enderror">
                    @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="2" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('address') border-red-500 @enderror">{{ old('address', $quotation->address) }}</textarea>
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code <span class="text-red-500">*</span></label>
                    <input type="text" name="zip_code" value="{{ old('zip_code', $quotation->zip_code) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('zip_code') border-red-500 @enderror">
                    @error('zip_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Project Description</h3>
            <textarea name="project_description" rows="3" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('project_description') border-red-500 @enderror">{{ old('project_description', $quotation->project_description) }}</textarea>
            @error('project_description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Line Items</h3>
            <div id="items-container">
                @php
                    $items = old('items', $quotation->items->toArray());
                @endphp
                @foreach($items as $index => $item)
                <div class="item-row grid grid-cols-12 gap-3 mb-3 p-3 border border-gray-200 rounded">
                    <div class="col-span-3">
                        <input type="text" name="items[{{ $index }}][item_name]" placeholder="Item Name" value="{{ $item['item_name'] ?? '' }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-3">
                        <input type="text" name="items[{{ $index }}][description]" placeholder="Description" value="{{ $item['description'] ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-2">
                        <input type="number" name="items[{{ $index }}][unit_price]" placeholder="Unit Price" value="{{ $item['unit_price'] ?? '' }}" step="0.01" min="0" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-1">
                        <input type="number" name="items[{{ $index }}][quantity]" placeholder="Qty" value="{{ $item['quantity'] ?? '' }}" min="1" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-2">
                        <input type="text" name="items[{{ $index }}][unit]" placeholder="Unit" value="{{ $item['unit'] ?? '' }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <button type="button" onclick="removeItemRow(this)" class="text-red-600 hover:text-red-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addItemRow()" class="mt-3 text-blue-600 hover:text-blue-800 font-medium">
                + Add Item
            </button>
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
            <a href="{{ route('admin.quotations.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                Update Quotation
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let itemCount = {{ count($items) }};

function addItemRow() {
    const container = document.getElementById('items-container');
    const newRow = document.createElement('div');
    newRow.className = 'item-row grid grid-cols-12 gap-3 mb-3 p-3 border border-gray-200 rounded';
    newRow.innerHTML = `
        <div class="col-span-3">
            <input type="text" name="items[${itemCount}][item_name]" placeholder="Item Name" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </div>
        <div class="col-span-3">
            <input type="text" name="items[${itemCount}][description]" placeholder="Description"
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemCount}][unit_price]" placeholder="Unit Price" step="0.01" min="0" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </div>
        <div class="col-span-1">
            <input type="number" name="items[${itemCount}][quantity]" placeholder="Qty" min="1" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </div>
        <div class="col-span-2">
            <input type="text" name="items[${itemCount}][unit]" placeholder="Unit" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </div>
        <div class="col-span-1 flex items-center justify-center">
            <button type="button" onclick="removeItemRow(this)" class="text-red-600 hover:text-red-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    `;
    container.appendChild(newRow);
    itemCount++;
}

function removeItemRow(button) {
    const container = document.getElementById('items-container');
    if (container.children.length > 1) {
        button.closest('.item-row').remove();
    } else {
        alert('At least one item is required.');
    }
}

document.getElementById('use_vat').addEventListener('change', function() {
    document.getElementById('vat_percentage').disabled = !this.checked;
});
</script>
@endpush
@endsection
