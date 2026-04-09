<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices',
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
        ]);

        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
            }

            $useVat = $request->has('use_vat');
            $vatPercentage = $useVat ? ($validated['vat_percentage'] ?? 11) : 0;
            $vatAmount = $useVat ? ($subtotal * $vatPercentage / 100) : 0;
            $total = $subtotal + $vatAmount;

            $invoice = Invoice::create([
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

            foreach ($validated['items'] as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoices.index')
                ->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('items');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('items');
        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number,' . $invoice->id,
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
        ]);

        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
            }

            $useVat = $request->has('use_vat');
            $vatPercentage = $useVat ? ($validated['vat_percentage'] ?? 11) : 0;
            $vatAmount = $useVat ? ($subtotal * $vatPercentage / 100) : 0;
            $total = $subtotal + $vatAmount;

            $invoice->update([
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

            $invoice->items()->delete();
            
            foreach ($validated['items'] as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoices.index')
                ->with('success', 'Invoice updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update invoice: ' . $e->getMessage());
        }
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function createFromQuotation(Quotation $quotation)
    {
        $quotation->load('items');
        
        return view('admin.invoices.create-from-quotation', compact('quotation'));
    }

    public function storeFromQuotation(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'use_vat' => 'boolean',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'terms' => 'nullable|string',
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

            $invoice = Invoice::create([
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
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'],
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['total'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoices.show', $invoice)
                ->with('success', 'Invoice created from quotation successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }
}
