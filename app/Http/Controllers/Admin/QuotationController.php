<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::latest()->paginate(10);
        return view('admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        return view('admin.quotations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quotation_number' => 'required|string|unique:quotations',
            'quotation_date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:quotation_date',
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

            $quotation = Quotation::create([
                'quotation_number' => $validated['quotation_number'],
                'quotation_date' => $validated['quotation_date'],
                'valid_until' => $validated['valid_until'],
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
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.quotations.index')
                ->with('success', 'Quotation created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create quotation: ' . $e->getMessage());
        }
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('items');
        return view('admin.quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $quotation->load('items');
        return view('admin.quotations.edit', compact('quotation'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'quotation_number' => 'required|string|unique:quotations,quotation_number,' . $quotation->id,
            'quotation_date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:quotation_date',
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

            $quotation->update([
                'quotation_number' => $validated['quotation_number'],
                'quotation_date' => $validated['quotation_date'],
                'valid_until' => $validated['valid_until'],
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

            $quotation->items()->delete();
            
            foreach ($validated['items'] as $item) {
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'total' => $item['unit_price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.quotations.index')
                ->with('success', 'Quotation updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update quotation: ' . $e->getMessage());
        }
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
}
