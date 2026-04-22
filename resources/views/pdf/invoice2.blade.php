<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice2 - {{ $document_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            margin: 0;
            padding: 10px;
            color: #333;
        }

        .terbilang-text {
            font-style: italic;
            color: #4b5563;
            font-size: 9pt;
        }

        .letterhead {
            border-bottom: 3px solid #dc2626;
            padding-bottom: 10px;
            margin-bottom: 10px;
            display: table;
            width: 100%;
        }

        .letterhead-left {
            display: table-cell;
            vertical-align: middle;
            width: 35%;
        }

        .letterhead-logo {
            width: 180px;
            height: 100px;
        }

        .letterhead-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .letterhead-right {
            display: table-cell;
            vertical-align: middle;
            padding-left: 20px;
        }

        .letterhead-company {
            font-size: 18pt;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 5px;
        }

        .letterhead-address {
            color: #6b7280;
            font-size: 10pt;
            line-height: 1.5;
        }

        .signature-image {
            width: 200px;
            height: 80px;
            margin: 0 auto 10px;
        }

        .signature-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 18pt;
            color: #dc2626;
            margin: 0 0 5px 0;
        }

        .header-info {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .header-info-left {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .header-info-right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            text-align: right;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 2px 0;
            font-size: 9pt;
        }

        .info-label {
            font-weight: bold;
            width: 130px;
        }

        .client-info {
            margin-bottom: 10px;
            padding: 6px 10px;
            background: #f9fafb;
            border-left: 4px solid #dc2626;
        }

        .client-info h3 {
            margin: 0 0 4px 0;
            color: #dc2626;
            font-size: 11pt;
        }

        .client-info p {
            margin: 2px 0;
            font-size: 9pt;
        }

        .project-description {
            margin-bottom: 10px;
            padding: 6px 10px;
            background: #f9fafb;
            border-radius: 4px;
        }

        .project-description h3 {
            margin: 0 0 4px 0;
            color: #dc2626;
            font-size: 11pt;
        }

        .project-description p {
            margin: 0;
            font-size: 9pt;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table.items th {
            background: #dc2626;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 9pt;
        }

        table.items td {
            padding: 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9pt;
        }

        table.items tr:nth-child(even) {
            background: #f9fafb;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .totals {
            width: 100%;
            margin-bottom: 10px;
        }

        .totals-table {
            width: 350px;
            margin-left: auto;
        }

        .totals-table td {
            padding: 3px 15px;
            font-size: 10pt;
        }

        .totals-table tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .totals-table .total-row {
            font-weight: bold;
            font-size: 12pt;
            background: #f3f4f6;
            border-top: 2px solid #dc2626;
        }

        .notes-terms-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .notes-col, .terms-col {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .notes-col {
            padding-right: 10px;
        }

        .terms-col {
            padding-left: 10px;
            border-left: 2px solid #e5e7eb;
        }

        .notes-col h3, .terms-col h3 {
            color: #dc2626;
            margin: 0 0 4px 0;
            font-size: 10pt;
        }

        .notes-col p, .terms-col p {
            margin: 0;
            font-size: 8pt;
        }

        .payment-details {
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #f9fafb;
            border-left: 4px solid #dc2626;
        }

        .payment-details h3 {
            color: #dc2626;
            margin: 0 0 8px 0;
            font-size: 12pt;
        }

        .payment-details p {
            margin: 3px 0;
            font-size: 10pt;
        }

        .signature {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-box {
            width: 250px;
            margin-left: auto;
            text-align: center;
        }

        .signature-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-title {
            color: #6b7280;
            font-size: 9pt;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 8pt;
        }
    </style>
</head>
<body>
    @php
    // Helper function to convert number to Indonesian words
    function terbilang($amount) {
        $amount = round($amount); // Round to nearest integer to avoid floating point issues
        $words = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];

        if ($amount < 0) {
            return 'Minus ' . terbilang(abs($amount));
        }

        if ($amount == 0) {
            return '';
        }

        if ($amount < 12) {
            return $words[$amount];
        } elseif ($amount < 20) {
            return terbilang($amount - 10) . ' Belas';
        } elseif ($amount < 100) {
            return terbilang(intval($amount / 10)) . ' Puluh ' . terbilang($amount % 10);
        } elseif ($amount < 200) {
            return 'Seratus ' . terbilang($amount - 100);
        } elseif ($amount < 1000) {
            return terbilang(intval($amount / 100)) . ' Ratus ' . terbilang($amount % 100);
        } elseif ($amount < 2000) {
            return 'Seribu ' . terbilang($amount - 1000);
        } elseif ($amount < 1000000) {
            return terbilang(intval($amount / 1000)) . ' Ribu ' . terbilang($amount % 1000);
        } elseif ($amount < 1000000000) {
            return terbilang(intval($amount / 1000000)) . ' Juta ' . terbilang($amount % 1000000);
        } elseif ($amount < 1000000000000) {
            return terbilang(intval($amount / 1000000000)) . ' Miliar ' . terbilang($amount % 1000000000);
        } else {
            return terbilang(intval($amount / 1000000000000)) . ' Triliun ' . terbilang($amount % 1000000000000);
        }
    }

    function formatTerbilang($amount) {
        $terbilang = strtoupper(trim(preg_replace('/\s+/', ' ', terbilang($amount))));
        return '(TERBILANG : ' . $terbilang . ' RUPIAH)';
    }
    @endphp

    <!-- Letterhead -->
    <div class="letterhead">
        <div class="letterhead-left">
            <div class="letterhead-logo">
                <img src="{{ public_path('storage/Logo-CDBPM.jpg') }}" alt="Company Logo">
            </div>
        </div>
        <div class="letterhead-right">
            <div class="letterhead-company">PT CAHAYA DIMENSI BUMI</div>
            <div class="letterhead-address">
                Jakarta, Indonesia<br>
                Email: info@cahayadimensibumi.com<br>
                Phone: 0851-7171-1375
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>INVOICE</h1>
    </div>

    <!-- Document Info -->
    <div class="header-info">
        <div class="header-info-left">
            <div class="client-info" style="margin-bottom:0;">
                <h3>To:</h3>
                <p><strong>{{ $company_name }}</strong></p>
                <p>{{ $address }}</p>
                <p>{{ $city }} {{ $zip_code }}</p>
            </div>
        </div>
        <div class="header-info-right">
            <table class="info-table">
                <tr>
                    <td class="info-label">Invoice Number:</td>
                    <td>{{ $document_number }}</td>
                </tr>
                <tr>
                    <td class="info-label">Invoice Date:</td>
                    <td>{{ $document_date }}</td>
                </tr>
                <tr>
                    <td class="info-label">Due Date:</td>
                    <td>{{ $valid_until }}</td>
                </tr>
                <tr>
                    <td class="info-label">Salesperson:</td>
                    <td>{{ $salesperson }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if($project_description)
    <div class="project-description">
        <h3>Project Description:</h3>
        <p>{{ $project_description }}</p>
    </div>
    @endif

    <!-- Items Table -->
    <table class="items">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Item Name</th>
                <th style="width: 25%;">Description</th>
                <th style="width: 10%;" class="text-center">Qty</th>
                <th style="width: 10%;" class="text-center">Unit</th>
                <th style="width: 10%;" class="text-right">Unit Price</th>
                <th style="width: 10%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->description ?? '-' }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-center">{{ $item->unit }}</td>
                <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals">
        <table class="totals-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($use_vat)
            <tr>
                <td>VAT ({{ $vat_percentage }}%):</td>
                <td class="text-right">Rp {{ number_format($vat_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td>Total:</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <!-- Payment Stages (Right-aligned below Total) -->
    @if(isset($stages) && $stages->count() > 0)
    <div style="margin-top: 10px;">
        @php
            // Find the first unpaid stage index
            $firstUnpaidIndex = null;
            foreach ($stages as $idx => $stage) {
                if ($stage->stage_status !== 'paid') {
                    $firstUnpaidIndex = $idx;
                    break;
                }
            }
        @endphp
        <table style="width: 480px; margin-left: auto; font-size: 9pt; border-collapse: collapse;">
            @foreach($stages as $index => $stage)
            @php
                $isHighlight = ($index === $firstUnpaidIndex);
            @endphp
            <tr style="@if($isHighlight) border-bottom: 2px solid #dc2626; @else border-bottom: 1px solid #e5e7eb; @endif">
                @if($isHighlight)
                <td style="padding: 6px 8px; text-align: left; font-style: italic; color: #6b7280; font-size: 7.5pt; white-space: nowrap; width: 50%;">
                    {{ formatTerbilang($stage->stage_amount) }}
                </td>
                @else
                <td style="padding: 6px 8px; text-align: left;"></td>
                @endif
                <td style="padding: 6px 8px; text-align: left; @if($isHighlight) font-weight: bold; @endif; font-size: 9pt;">
                    {{ $stage->stage_name }} ({{ $stage->stage_percentage }}%)
                </td>
                <td style="padding: 6px 8px; text-align: right; @if($isHighlight) font-weight: bold; @endif; font-size: 9pt;">
                    Rp {{ number_format($stage->stage_amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <!-- Notes & Terms -->
    @if($notes || $terms)
    <div class="notes-terms-row">
        @if($notes)
        <div class="notes-col">
            <h3>Notes:</h3>
            <p>{{ $notes }}</p>
        </div>
        @endif
        @if($terms)
        <div class="terms-col">
            <h3>Terms & Conditions:</h3>
            <p>{{ $terms }}</p>
        </div>
        @endif
    </div>
    @endif

    <!-- Payment Details + Signature -->
    <div class="payment-details" style="margin-bottom:10px; padding:8px 12px;">
        <h3 style="font-size:11pt; margin-bottom:5px;">PAYMENT DETAILS</h3>
        <p style="font-size:9pt; margin:2px 0;"><strong>Account Name:</strong> Valerie Febriana Putri</p>
        <p style="font-size:9pt; margin:2px 0;"><strong>Account Number:</strong> 742 515 2637</p>
        <p style="font-size:9pt; margin:2px 0;"><strong>Bank Name:</strong> BCA</p>
    </div>

    <div class="signature" style="margin-top:15px;">
        <div class="signature-box">
            <p style="margin:0; font-size:9pt;">Jakarta, {{ date('d F Y') }}</p>
            <p style="margin:0; font-size:9pt;">PT Cahaya Dimensi Bumi</p>
            <div class="signature-image" style="width:180px; height:70px; margin:5px auto;">
                <img src="{{ public_path('storage/signature.jpg') }}" alt="Signature" style="width:100%; height:100%; object-fit:contain;">
            </div>
            <div class="signature-name" style="font-size:10pt;">Valerie Febriana Putri</div>
            <div class="signature-title" style="font-size:8pt;">Director</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Thank you for your business. We appreciate your trust in PT Cahaya Dimensi Bumi.
    </div>
</body>
</html>
