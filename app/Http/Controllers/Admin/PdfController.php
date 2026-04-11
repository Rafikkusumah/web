<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Invoice2;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function downloadQuotation(Quotation $quotation)
    {
        $quotation->load('items');
        
        $data = [
            'type' => 'Quotation',
            'document_number' => $quotation->quotation_number,
            'document_date' => $quotation->quotation_date->format('F d, Y'),
            'valid_until' => $quotation->valid_until->format('F d, Y'),
            'salesperson' => $quotation->salesperson,
            'company_name' => $quotation->company_name,
            'address' => $quotation->address,
            'city' => $quotation->city,
            'zip_code' => $quotation->zip_code,
            'project_description' => $quotation->project_description,
            'items' => $quotation->items,
            'subtotal' => $quotation->subtotal,
            'use_vat' => $quotation->use_vat,
            'vat_percentage' => $quotation->vat_percentage,
            'vat_amount' => $quotation->vat_amount,
            'total' => $quotation->total,
            'notes' => $quotation->notes,
            'terms' => $quotation->terms,
        ];
        
        $pdf = Pdf::loadView('pdf.quotation', $data);
        return $pdf->download('Quotation-' . $quotation->quotation_number . '.pdf');
    }

    public function downloadInvoice(Invoice $invoice)
    {
        $invoice->load('items');
        
        $data = [
            'type' => 'Invoice',
            'document_number' => $invoice->invoice_number,
            'document_date' => $invoice->invoice_date->format('F d, Y'),
            'valid_until' => $invoice->due_date->format('F d, Y'),
            'salesperson' => $invoice->salesperson,
            'company_name' => $invoice->company_name,
            'address' => $invoice->address,
            'city' => $invoice->city,
            'zip_code' => $invoice->zip_code,
            'project_description' => $invoice->project_description,
            'items' => $invoice->items,
            'subtotal' => $invoice->subtotal,
            'use_vat' => $invoice->use_vat,
            'vat_percentage' => $invoice->vat_percentage,
            'vat_amount' => $invoice->vat_amount,
            'total' => $invoice->total,
            'notes' => $invoice->notes,
            'terms' => $invoice->terms,
        ];
        
        $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function downloadInvoice2(Invoice2 $invoice2)
    {
        $invoice2->load(['items', 'stages']);

        $data = [
            'type' => 'Invoice',
            'document_number' => $invoice2->invoice_number,
            'document_date' => $invoice2->invoice_date->format('F d, Y'),
            'valid_until' => $invoice2->due_date->format('F d, Y'),
            'salesperson' => $invoice2->salesperson,
            'company_name' => $invoice2->company_name,
            'address' => $invoice2->address,
            'city' => $invoice2->city,
            'zip_code' => $invoice2->zip_code,
            'project_description' => $invoice2->project_description,
            'items' => $invoice2->items,
            'subtotal' => $invoice2->subtotal,
            'use_vat' => $invoice2->use_vat,
            'vat_percentage' => $invoice2->vat_percentage,
            'vat_amount' => $invoice2->vat_amount,
            'total' => $invoice2->total,
            'notes' => $invoice2->notes,
            'terms' => $invoice2->terms,
            'stages' => $invoice2->stages,
        ];

        $pdf = Pdf::loadView('pdf.invoice2', $data);
        return $pdf->download('Invoice2-' . $invoice2->invoice_number . '.pdf');
    }
}
