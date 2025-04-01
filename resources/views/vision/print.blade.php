<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Prescription #{{ $prescription->invoice_no }}</title>
    <style>
        @page {
            size: A5;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 148mm;
            margin: 0 auto;
            padding: 10mm;
        }
        .header {
            text-align: center;
            margin-bottom: 10mm;
        }
        .header img {
            height: 20mm;
        }
        .header h1 {
            margin: 2mm 0;
            font-size: 6mm;
        }
        .header p {
            margin: 1mm 0;
            font-size: 3mm;
        }
        .info-section {
            margin-bottom: 5mm;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2mm;
        }
        .info-label {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5mm 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 2mm;
            font-size: 3mm;
        }
        th {
            background-color: #f0f0f0;
        }
        .prescription-table {
            margin: 5mm 0;
        }
        .prescription-table th {
            text-align: center;
        }
        .amount-section {
            text-align: right;
            margin-top: 5mm;
        }
        .amount-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2mm;
        }
        .amount-label {
            margin-right: 5mm;
        }
        .footer {
            margin-top: 10mm;
            text-align: center;
            font-size: 3mm;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Temporarily commented out until GD extension is installed -->
            <!-- <img src="{{ public_path('visionui/img/logo.png') }}" alt="Logo"> -->
            <h1>VISION OPTICALS</h1>
            <p>41, Prakash Nagar Near Navlakha Square, Indore (M.P.) | Mobile No.: +91 9854548448</p>
        </div>

        <div class="info-section">
            <div class="info-row">
                <span class="info-label">No.:</span>
                <span>{{ $prescription->invoice_no }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date:</span>
                <span>{{ $prescription->date->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span>{{ $prescription->customer_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Mobile:</span>
                <span>{{ $prescription->mobile_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Prescription Type:</span>
                <span>{{ $prescription->prescription_type }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Items</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Frame</td>
                    <td>{{ $prescription->frame_description }}</td>
                    <td>₹{{ $prescription->frame_amount }}</td>
                </tr>
                <tr>
                    <td>Glass</td>
                    <td>{{ $prescription->glass_description }}</td>
                    <td>₹{{ $prescription->glass_amount }}</td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>{{ $prescription->photo_description }}</td>
                    <td>₹{{ $prescription->photo_amount }}</td>
                </tr>
                <tr>
                    <td>Other</td>
                    <td>{{ $prescription->other_description }}</td>
                    <td>₹{{ $prescription->other }}</td>
                </tr>
            </tbody>
        </table>

        <table class="prescription-table">
            <thead>
                <tr>
                    <th></th>
                    <th>SPH</th>
                    <th>CYL</th>
                    <th>AXIS</th>
                    <th>VISION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>RE</strong></td>
                    <td>{{ $prescription->re_sph }}</td>
                    <td>{{ $prescription->re_cyl }}</td>
                    <td>{{ $prescription->re_axis }}</td>
                    <td>{{ $prescription->re_vision }}</td>
                </tr>
                <tr>
                    <td><strong>LE</strong></td>
                    <td>{{ $prescription->le_sph }}</td>
                    <td>{{ $prescription->le_cyl }}</td>
                    <td>{{ $prescription->le_axis }}</td>
                    <td>{{ $prescription->le_vision }}</td>
                </tr>
            </tbody>
        </table>

        <div class="amount-section">
            <div class="amount-row">
                <span class="amount-label">Total:</span>
                <span>₹{{ $prescription->total }}</span>
            </div>
            <div class="amount-row">
                <span class="amount-label">Advance:</span>
                <span>₹{{ $prescription->advance }}</span>
            </div>
            <div class="amount-row">
                <span class="amount-label">Balance:</span>
                <span>₹{{ $prescription->balance }}</span>
            </div>
        </div>

        <div class="footer">
            <p><strong>Remark:</strong> {{ $prescription->remarks }}</p>
        </div>
    </div>
</body>
</html> 