@extends('layouts.admin')

@section('page-title', 'Create Invoice2 from Quotation')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
        <h3 class="text-lg font-semibold text-purple-900 mb-2">Creating Invoice2 (Stages) from Quotation</h3>
        <p class="text-purple-700">
            <strong>Quotation:</strong> {{ $quotation->quotation_number }}<br>
            <strong>Company:</strong> {{ $quotation->company_name }}<br>
            <strong>Total:</strong> Rp {{ number_format($quotation->total, 0, ',', '.') }}
        </p>
        <p class="text-sm text-purple-600 mt-2">All data from quotation will be copied. Set your payment stages below.</p>
    </div>

    <form action="{{ route('admin.invoice2.store-from-quotation', $quotation) }}" method="POST" id="invoice-form">
        @csrf

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

        {{-- Client Info (readonly) --}}
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

        {{-- Project Description (readonly) --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Project Description</h3>
            <textarea rows="3" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">{{ $quotation->project_description }}</textarea>
        </div>

        {{-- Line Items (readonly) --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Line Items (Copied from Quotation)</h3>
            <div class="overflow-x-auto">
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
        </div>

        {{-- VAT --}}
        <div class="border-t border-gray-200 pt-6 mb-6">
            <div class="flex items-center mb-4">
                <input type="checkbox" id="use_vat" name="use_vat" value="1" {{ old('use_vat', $quotation->use_vat) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="use_vat" class="ml-2 block text-sm text-gray-700">Apply VAT</label>
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
                    </tbody>
                </table>
            </div>

            {{-- Stage Total Indicator --}}
            <div class="mt-4 p-4 rounded-lg bg-yellow-50 border border-yellow-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Total Percentage:</span>
                    <span id="total-percentage" class="text-lg font-bold text-yellow-600">0%</span>
                </div>
                <p id="total-message" class="text-sm mt-1 text-yellow-600">
                    Select a preset above or add custom stages. Total must equal 100%.
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
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('notes', $quotation->notes) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                    <textarea name="terms" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('terms', $quotation->terms) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.quotations.show', $quotation) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-semibold">
                Create Invoice2
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let stageCount = 0;

document.getElementById('use_vat').addEventListener('change', function() {
    document.getElementById('vat_percentage').disabled = !this.checked;
});

function addStageRow(name = '', percentage = '', dueDate = '', notes = '') {
    const container = document.getElementById('stages-container');
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
    container.appendChild(newRow);
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
