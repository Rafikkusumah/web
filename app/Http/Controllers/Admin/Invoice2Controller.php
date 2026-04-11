<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice2;
use App\Models\Invoice2Item;
use App\Models\Invoice2Stage;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Invoice2Controller extends Controller
{
    public function index()
    {
        $invoices = Invoice2::with('stages')->latest()->paginate(10);
        return view('admin.invoice2.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoice2.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoice2',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'salesperson' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'project_description' => 'required|string',
            'use_vat' => 'boolean',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'terms' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit' => 'required|string|max:50',
            'stages' => 'required|array|min:1',
            'stages.*.stage_name' => 'required|string|max:255',
            'stages.*.stage_percentage' => 'required|numeric|min:0|max:100',
            'stages.*.stage_due_date' => 'required|date',
            'stages.*.stage_notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Calculate subtotal from items
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
            }

            $useVat = $request->has('use_vat');
            $vatPercentage = $useVat ? ($validated['vat_percentage'] ?? 11) : 0;
            $vatAmount = $useVat ? ($subtotal * $vatPercentage / 100) : 0;
            $total = $subtotal + $vatAmount;

            // Validate stages total = 100%
            $stagesTotal = 0;
            foreach ($validated['stages'] as $stage) {
                $stagesTotal += $stage['stage_percentage'];
            }

            if (abs($stagesTotal - 100) > 0.01) {
                return back()->with('error', 'Total payment stages must equal 100%. Current total: ' . number_format($stagesTotal, 2) . '%')
                    ->withInput();
            }

            // Create invoice
            $invoice = Invoice2::create([
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'salesperson' => $validated['salesperson'],
                'company_name' => $validated['company_name'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'project_description' => $validated['project_description'],
                'subtotal' => $subtotal,
                'use_vat' => $useVat,
                'vat_percentage' => $vatPercentage,
                'vat_amount' => $vatAmount,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
                'terms' => $validated['terms'] ?? null,
            ]);

            // Create items
            foreach ($validated['items'] as $item) {
                Invoice2Item::create([
                    'invoice2_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            // Create stages with calculated amounts
            foreach ($validated['stages'] as $stage) {
                $stageAmount = $total * $stage['stage_percentage'] / 100;
                Invoice2Stage::create([
                    'invoice2_id' => $invoice->id,
                    'stage_name' => $stage['stage_name'],
                    'stage_percentage' => $stage['stage_percentage'],
                    'stage_amount' => $stageAmount,
                    'stage_due_date' => $stage['stage_due_date'],
                    'stage_status' => 'unpaid',
                    'stage_notes' => $stage['stage_notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoice2.index')
                ->with('success', 'Invoice2 created successfully with payment stages.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Invoice2 $invoice2)
    {
        $invoice2->load(['items', 'stages']);
        return view('admin.invoice2.show', compact('invoice2'));
    }

    public function edit(Invoice2 $invoice2)
    {
        $invoice2->load(['items', 'stages']);
        return view('admin.invoice2.edit', compact('invoice2'));
    }

    public function update(Request $request, Invoice2 $invoice2)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoice2,invoice_number,' . $invoice2->id,
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'salesperson' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'project_description' => 'required|string',
            'use_vat' => 'boolean',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'terms' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit' => 'required|string|max:50',
            'stages' => 'required|array|min:1',
            'stages.*.stage_name' => 'required|string|max:255',
            'stages.*.stage_percentage' => 'required|numeric|min:0|max:100',
            'stages.*.stage_due_date' => 'required|date',
            'stages.*.stage_notes' => 'nullable|string',
            'stages.*.stage_status' => 'required|in:unpaid,paid,overdue',
        ]);

        DB::beginTransaction();
        try {
            // Calculate subtotal from items
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
            }

            $useVat = $request->has('use_vat');
            $vatPercentage = $useVat ? ($validated['vat_percentage'] ?? 11) : 0;
            $vatAmount = $useVat ? ($subtotal * $vatPercentage / 100) : 0;
            $total = $subtotal + $vatAmount;

            // Validate stages total = 100%
            $stagesTotal = 0;
            foreach ($validated['stages'] as $stage) {
                $stagesTotal += $stage['stage_percentage'];
            }

            if (abs($stagesTotal - 100) > 0.01) {
                return back()->with('error', 'Total payment stages must equal 100%. Current total: ' . number_format($stagesTotal, 2) . '%')
                    ->withInput();
            }

            // Update invoice
            $invoice2->update([
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'salesperson' => $validated['salesperson'],
                'company_name' => $validated['company_name'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'project_description' => $validated['project_description'],
                'subtotal' => $subtotal,
                'use_vat' => $useVat,
                'vat_percentage' => $vatPercentage,
                'vat_amount' => $vatAmount,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
                'terms' => $validated['terms'] ?? null,
            ]);

            // Delete and recreate items
            $invoice2->items()->delete();
            foreach ($validated['items'] as $item) {
                Invoice2Item::create([
                    'invoice2_id' => $invoice2->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            // Delete and recreate stages
            $invoice2->stages()->delete();
            foreach ($validated['stages'] as $stage) {
                $stageAmount = $total * $stage['stage_percentage'] / 100;
                Invoice2Stage::create([
                    'invoice2_id' => $invoice2->id,
                    'stage_name' => $stage['stage_name'],
                    'stage_percentage' => $stage['stage_percentage'],
                    'stage_amount' => $stageAmount,
                    'stage_due_date' => $stage['stage_due_date'],
                    'stage_status' => $stage['stage_status'],
                    'stage_notes' => $stage['stage_notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoice2.index')
                ->with('success', 'Invoice2 updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Invoice2 $invoice2)
    {
        $invoice2->delete();

        return redirect()->route('admin.invoice2.index')
            ->with('success', 'Invoice2 deleted successfully.');
    }

    /**
     * Update stage status (mark as paid/unpaid/overdue)
     */
    public function updateStageStatus(Request $request, Invoice2Stage $stage)
    {
        $validated = $request->validate([
            'stage_status' => 'required|in:unpaid,paid,overdue',
        ]);

        $stage->update($validated);

        return back()->with('success', 'Stage status updated.');
    }

    public function createFromQuotation(Quotation $quotation)
    {
        $quotation->load('items');

        return view('admin.invoice2.create-from-quotation', compact('quotation'));
    }

    public function storeFromQuotation(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoice2',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'use_vat' => 'boolean',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'terms' => 'nullable|string',
            'stages' => 'required|array|min:1',
            'stages.*.stage_name' => 'required|string|max:255',
            'stages.*.stage_percentage' => 'required|numeric|min:0|max:100',
            'stages.*.stage_due_date' => 'required|date',
            'stages.*.stage_notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Copy items from quotation
            $items = [];
            $subtotal = 0;
            foreach ($quotation->items as $item) {
                $items[] = [
                    'item_name' => $item->item_name,
                    'description' => $item->description,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'unit' => $item->unit,
                    'total' => $item->total,
                ];
                $subtotal += $item->total;
            }

            $useVat = $request->has('use_vat');
            $vatPercentage = $useVat ? ($validated['vat_percentage'] ?? $quotation->vat_percentage) : 0;
            $vatAmount = $useVat ? ($subtotal * $vatPercentage / 100) : 0;
            $total = $subtotal + $vatAmount;

            // Validate stages total = 100%
            $stagesTotal = 0;
            foreach ($validated['stages'] as $stage) {
                $stagesTotal += $stage['stage_percentage'];
            }

            if (abs($stagesTotal - 100) > 0.01) {
                return back()->with('error', 'Total payment stages must equal 100%. Current total: ' . number_format($stagesTotal, 2) . '%')
                    ->withInput();
            }

            $invoice = Invoice2::create([
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'salesperson' => $quotation->salesperson,
                'company_name' => $quotation->company_name,
                'address' => $quotation->address,
                'city' => $quotation->city,
                'zip_code' => $quotation->zip_code,
                'project_description' => $quotation->project_description,
                'subtotal' => $subtotal,
                'use_vat' => $useVat,
                'vat_percentage' => $vatPercentage,
                'vat_amount' => $vatAmount,
                'total' => $total,
                'notes' => $validated['notes'] ?? $quotation->notes,
                'terms' => $validated['terms'] ?? $quotation->terms,
            ]);

            foreach ($items as $item) {
                Invoice2Item::create([
                    'invoice2_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'],
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['total'],
                ]);
            }

            // Create stages with calculated amounts
            foreach ($validated['stages'] as $stage) {
                $stageAmount = $total * $stage['stage_percentage'] / 100;
                Invoice2Stage::create([
                    'invoice2_id' => $invoice->id,
                    'stage_name' => $stage['stage_name'],
                    'stage_percentage' => $stage['stage_percentage'],
                    'stage_amount' => $stageAmount,
                    'stage_due_date' => $stage['stage_due_date'],
                    'stage_status' => 'unpaid',
                    'stage_notes' => $stage['stage_notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoice2.show', $invoice)
                ->with('success', 'Invoice2 created from quotation successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create invoice: ' . $e->getMessage())->withInput();
        }
    }
}
