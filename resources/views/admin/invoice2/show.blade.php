@extends('layouts.admin')

@section('page-title', 'Invoice2 Detail')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    {{-- Header Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h2 class="text-xl font-bold mb-4">{{ $invoice2->invoice_number }}</h2>
            <dl class="space-y-2">
                <dt class="text-sm font-medium text-gray-500">Salesperson</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->salesperson }}</dd>

                <dt class="text-sm font-medium text-gray-500">Invoice Date</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->invoice_date->format('M d, Y') }}</dd>

                <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->due_date->format('M d, Y') }}</dd>
            </dl>
        </div>
        <div>
            <h2 class="text-xl font-bold mb-4">Client Information</h2>
            <dl class="space-y-2">
                <dt class="text-sm font-medium text-gray-500">Company</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->company_name }}</dd>

                <dt class="text-sm font-medium text-gray-500">Address</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->address }}</dd>

                <dt class="text-sm font-medium text-gray-500">City</dt>
                <dd class="text-sm text-gray-900">{{ $invoice2->city }}, {{ $invoice2->zip_code }}</dd>
            </dl>
        </div>
    </div>

    {{-- Project Description --}}
    @if($invoice2->project_description)
    <div class="border-t border-gray-200 pt-4 mb-6">
        <h3 class="text-sm font-medium text-gray-500 mb-2">Project Description</h3>
        <p class="text-sm text-gray-900">{{ $invoice2->project_description }}</p>
    </div>
    @endif

    {{-- Line Items --}}
    <div class="border-t border-gray-200 pt-4 mb-6">
        <h3 class="text-lg font-semibold mb-4">Line Items</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($invoice2->items as $item)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ $item->item_name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-500">{{ $item->description }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ $item->quantity }} {{ $item->unit }}</td>
                    <td class="px-4 py-2 text-sm font-semibold text-gray-900">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Summary --}}
    <div class="border-t border-gray-200 pt-4 mb-6">
        <div class="w-full md:w-1/2 ml-auto">
            <div class="flex justify-between py-2">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium">Rp {{ number_format($invoice2->subtotal, 0, ',', '.') }}</span>
            </div>
            @if($invoice2->use_vat)
            <div class="flex justify-between py-2">
                <span class="text-gray-600">VAT ({{ $invoice2->vat_percentage }}%)</span>
                <span class="font-medium">Rp {{ number_format($invoice2->vat_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="flex justify-between py-2 border-t border-gray-200 font-bold text-lg">
                <span>Total</span>
                <span>Rp {{ number_format($invoice2->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Payment Stages --}}
    <div class="border-t border-gray-200 pt-4 mb-6">
        <h3 class="text-lg font-semibold mb-4">Payment Stages</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stage Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Percentage</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Notes</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($invoice2->stages as $index => $stage)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $stage->stage_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $stage->stage_percentage }}%</td>
                        <td class="px-4 py-2 text-sm font-semibold text-gray-900">Rp {{ number_format($stage->stage_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $stage->stage_due_date->format('M d, Y') }}</td>
                        <td class="px-4 py-2">
                            @if($stage->stage_status === 'paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Paid</span>
                            @elseif($stage->stage_status === 'overdue')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Overdue</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Unpaid</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $stage->stage_notes ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.invoice2.stages.status', $stage) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="stage_status" onchange="this.form.submit()" class="text-sm border border-gray-300 rounded px-2 py-1">
                                    <option value="unpaid" {{ $stage->stage_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ $stage->stage_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="overdue" {{ $stage->stage_status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Notes & Terms --}}
    @if($invoice2->notes || $invoice2->terms)
    <div class="border-t border-gray-200 pt-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($invoice2->notes)
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Notes</h3>
                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $invoice2->notes }}</p>
            </div>
            @endif
            @if($invoice2->terms)
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Terms & Conditions</h3>
                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $invoice2->terms }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Actions--}}
    <div class="mt-6 flex space-x-3">
        <a href="{{ route('admin.invoice2.pdf', $invoice2) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
            Download PDF
        </a>
        <a href="{{ route('admin.invoice2.edit', $invoice2) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-semibold">
            Edit
        </a>
        <a href="{{ route('admin.invoice2.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
            Back to List
        </a>
    </div>
</div>
@endsection
