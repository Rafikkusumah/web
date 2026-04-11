@extends('layouts.admin')

@section('page-title', 'Create Invoice2')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.invoice2.store') }}" method="POST" id="invoice-form">
        @csrf

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Number <span class="text-red-500">*</span></label>
                <input type="text" name="invoice_number" value="{{ old('invoice_number', 'INV2-' . date('Ymd') . '-001') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('invoice_number') border-red-500 @enderror">
                @error('invoice_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Salesperson <span class="text-red-500">*</span></label>
                <input type="text" name="salesperson" value="{{ old('salesperson', 'Valerie Febriana Putri') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('salesperson') border-red-500 @enderror">
                @error('salesperson')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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

        {{-- Client Information --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Client Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('city') border-red-500 @enderror">
                    @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="2" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code <span class="text-red-500">*</span></label>
                    <input type="text" name="zip_code" value="{{ old('zip_code') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('zip_code') border-red-500 @enderror">
                    @error('zip_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Project Description --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Project Description</h3>
            <textarea name="project_description" rows="3" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('project_description') border-red-500 @enderror">{{ old('project_description') }}</textarea>
            @error('project_description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Line Items --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Line Items</h3>
            <div id="items-container">
                @if(old('items'))
                    @foreach(old('items') as $index => $item)
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
                @else
                <div class="item-row grid grid-cols-12 gap-3 mb-3 p-3 border border-gray-200 rounded">
                    <div class="col-span-3">
                        <input type="text" name="items[0][item_name]" placeholder="Item Name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-3">
                        <input type="text" name="items[0][description]" placeholder="Description"
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-2">
                        <input type="number" name="items[0][unit_price]" placeholder="Unit Price" step="0.01" min="0" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-1">
                        <input type="number" name="items[0][quantity]" placeholder="Qty" min="1" required
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                    </div>
                    <div class="col-span-2">
                        <input type="text" name="items[0][unit]" placeholder="Unit" required
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
                @endif
            </div>
            <button type="button" onclick="addItemRow()" class="mt-3 text-blue-600 hover:text-blue-800 font-medium">
                + Add Item
            </button>
        </div>

        {{-- VAT --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <div class="flex items-center mb-4">
                <input type="checkbox" id="use_vat" name="use_vat" value="1" {{ old('use_vat') ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="use_vat" class="ml-2 block text-sm text-gray-700">
                    Apply VAT
                </label>
                <input type="number" name="vat_percentage" id="vat_percentage" value="{{ old('vat_percentage', 11) }}" step="0.01" min="0" max="100"
                    class="ml-4 w-24 px-3 py-2 border border-gray-300 rounded text-sm"
                    {{ !old('use_vat') ? 'disabled' : '' }}>
                <span class="ml-2 text-sm text-gray-700">%</span>
            </div>
        </div>

        {{-- Payment Stages --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Payment Stages <span class="text-red-500">*</span></h3>
                <div class="space-x-2">
                    <button type="button" onclick="applyPreset('50-50')" class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200">
                        50% DP + 50% After Install
                    </button>
                    <button type="button" onclick="applyPreset('40-30-20-10')" class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded hover:bg-green-200">
                        40% DP + 30% MBD + 20% After + 10% Retention
                    </button>
                    <button type="button" onclick="addStageRow()" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded hover:bg-gray-200">
                        + Add Custom Stage
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stage Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-28">Percentage (%)</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-40">Due Date</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-48">Notes</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-12"></th>
                        </tr>
                    </thead>
                    <tbody id="stages-container">
                        @if(old('stages'))
                            @foreach(old('stages') as $index => $stage)
                            @include('admin.invoice2.partials.stage-row', ['index' => $index, 'stage' => $stage])
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Stage Total Indicator --}}
            <div class="mt-4 p-4 rounded-lg @if(old('stages_total', 0) == 100) bg-green-50 border border-green-200 @else bg-yellow-50 border border-yellow-200 @endif">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Total Percentage:</span>
                    <span id="total-percentage" class="text-lg font-bold @if(old('stages_total', 0) == 100) text-green-600 @else text-yellow-600 @endif">{{ old('stages_total', 0) }}%</span>
                </div>
                <p id="total-message" class="text-sm mt-1 @if(old('stages_total', 0) == 100) text-green-600 @else text-yellow-600 @endif">
                    @if(old('stages_total', 0) == 100)
                        ✓ Total equals 100%
                    @elseif(old('stages_total', 0) > 0)
                        ⚠ Total must equal 100%. Add more stages or adjust percentages.
                    @else
                        Select a preset above or add custom stages.
                    @endif
                </p>
            </div>
        </div>

        {{-- Notes & Terms --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Notes & Terms</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('notes') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                    <textarea name="terms" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('terms') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.invoice2.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                Create Invoice2
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let itemCount = {{ old('items') ? count(old('items')) : 1 }};
let stageCount = {{ old('stages') ? count(old('stages')) : 0 }};

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

// ---- Payment Stage Functions ----

function addStageRow(name = '', percentage = '', dueDate = '', notes = '') {
    const container = document.getElementById('stages-container');
    const tbody = container;
    const newRow = document.createElement('tr');
    newRow.className = 'stage-row border-b border-gray-200';
    newRow.innerHTML = `
        <td class="px-4 py-2">
            <input type="text" name="stages[${stageCount}][stage_name]" placeholder="e.g. Down Payment" value="${name}" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </td>
        <td class="px-4 py-2">
            <input type="number" name="stages[${stageCount}][stage_percentage]" placeholder="%" value="${percentage}" step="0.01" min="0" max="100" required
                class="stage-percentage w-full px-3 py-2 border border-gray-300 rounded text-sm"
                oninput="updateTotalPercentage()">
        </td>
        <td class="px-4 py-2">
            <input type="date" name="stages[${stageCount}][stage_due_date]" value="${dueDate}" required
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
        </td>
        <td class="px-4 py-2">
            <textarea name="stages[${stageCount}][stage_notes]" placeholder="Optional notes" rows="1"
                class="w-full px-3 py-2 border border-gray-300 rounded text-sm">${notes}</textarea>
        </td>
        <td class="px-4 py-2">
            <button type="button" onclick="removeStageRow(this)" class="text-red-600 hover:text-red-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
    stageCount++;
    updateTotalPercentage();
}

function removeStageRow(button) {
    const container = document.getElementById('stages-container');
    if (container.children.length > 1) {
        button.closest('.stage-row').remove();
        updateTotalPercentage();
    } else {
        alert('At least one payment stage is required.');
    }
}

function updateTotalPercentage() {
    let total = 0;
    document.querySelectorAll('.stage-percentage').forEach(input => {
        total += parseFloat(input.value) || 0;
    });

    const totalEl = document.getElementById('total-percentage');
    const msgEl = document.getElementById('total-message');
    const parent = totalEl.closest('div').parentElement;

    totalEl.textContent = total.toFixed(2) + '%';

    if (Math.abs(total - 100) < 0.01) {
        totalEl.className = 'text-lg font-bold text-green-600';
        msgEl.className = 'text-sm mt-1 text-green-600';
        msgEl.textContent = '✓ Total equals 100%';
        parent.className = 'mt-4 p-4 rounded-lg bg-green-50 border border-green-200';
    } else {
        totalEl.className = 'text-lg font-bold text-yellow-600';
        msgEl.className = 'text-sm mt-1 text-yellow-600';
        msgEl.textContent = '⚠ Total must equal 100%. Current: ' + total.toFixed(2) + '%';
        parent.className = 'mt-4 p-4 rounded-lg bg-yellow-50 border border-yellow-200';
    }

    // Update hidden input for form submission
    let hiddenInput = document.getElementById('stages-total-hidden');
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'stages-total-hidden';
        hiddenInput.name = 'stages_total';
        totalEl.closest('.flex').parentElement.appendChild(hiddenInput);
    }
    hiddenInput.value = total.toFixed(2);
}

function applyPreset(preset) {
    const container = document.getElementById('stages-container');
    container.innerHTML = '';
    stageCount = 0;

    const today = new Date();

    if (preset === '50-50') {
        const dueDate1 = new Date(today);
        dueDate1.setDate(today.getDate() + 7);
        const dueDate2 = new Date(today);
        dueDate2.setDate(today.getDate() + 30);

        addStageRow('Down Payment', '50', dueDate1.toISOString().split('T')[0], 'Initial payment before work begins');
        addStageRow('After Installation', '50', dueDate2.toISOString().split('T')[0], 'Payment after installation complete');
    } else if (preset === '40-30-20-10') {
        const dueDate1 = new Date(today);
        dueDate1.setDate(today.getDate() + 7);
        const dueDate2 = new Date(today);
        dueDate2.setDate(today.getDate() + 21);
        const dueDate3 = new Date(today);
        dueDate3.setDate(today.getDate() + 45);
        const dueDate4 = new Date(today);
        dueDate4.setDate(today.getDate() + 60);

        addStageRow('Down Payment', '40', dueDate1.toISOString().split('T')[0], 'Initial payment');
        addStageRow('MBD (Material Bring to Site)', '30', dueDate2.toISOString().split('T')[0], 'When materials arrive on site');
        addStageRow('After Installation', '20', dueDate3.toISOString().split('T')[0], 'After installation complete');
        addStageRow('Retention', '10', dueDate4.toISOString().split('T')[0], 'Final retention after warranty period');
    }
}
</script>
@endpush
@endsection
