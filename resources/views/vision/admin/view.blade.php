@extends('vision.layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>View Prescription</h1>
        <div class="page-actions">
            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('prescription.print', $prescription) }}" target="_blank" class="btn btn-success">Print</a>
            
            @if($prescription->payment_status != 'completed')
                <form action="{{ route('admin.prescriptions.markAsPaid', $prescription) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-payment">Mark as Paid</button>
                </form>
            @endif
        </div>
    </div>

    <div class="prescription-details">
        <div class="prescription-header">
            <div class="header-item">
                <strong>Invoice #:</strong> {{ $prescription->invoice_no }}
            </div>
            <div class="header-item">
                <strong>Date:</strong> {{ $prescription->date->format('d/m/Y') }}
            </div>
            <div class="header-item">
                <strong>Customer:</strong> {{ $prescription->customer_name }}
            </div>
            <div class="header-item">
                <strong>Mobile:</strong> {{ $prescription->mobile_number }}
            </div>
            <div class="header-item">
                <strong>Prescription Type:</strong> {{ $prescription->prescription_type }}
            </div>
            <div class="header-item">
                <strong>Payment Status:</strong> 
                <span class="status-badge status-{{ $prescription->payment_status }}">
                    {{ ucfirst($prescription->payment_status) }}
                </span>
            </div>
        </div>

        <div class="section">
            <h2>Items</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th class="amount-column">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if($prescription->frame_description || $prescription->frame_amount)
                    <tr>
                        <td>Frame</td>
                        <td>{{ $prescription->frame_description }}</td>
                        <td class="amount-column">₹ {{ number_format($prescription->frame_amount) }}</td>
                    </tr>
                    @endif
                    
                    @if($prescription->glass_description || $prescription->glass_amount)
                    <tr>
                        <td>Glass</td>
                        <td>{{ $prescription->glass_description }}</td>
                        <td class="amount-column">₹ {{ number_format($prescription->glass_amount) }}</td>
                    </tr>
                    @endif
                    
                    @if($prescription->photo_description || $prescription->photo_amount)
                    <tr>
                        <td>Photo</td>
                        <td>{{ $prescription->photo_description }}</td>
                        <td class="amount-column">₹ {{ number_format($prescription->photo_amount) }}</td>
                    </tr>
                    @endif
                    
                    @if($prescription->other_description || $prescription->other)
                    <tr>
                        <td>Other</td>
                        <td>{{ $prescription->other_description }}</td>
                        <td class="amount-column">₹ {{ number_format($prescription->other) }}</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="total-label">Total</td>
                        <td class="amount-column">₹ {{ number_format($prescription->total) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="total-label">Advance</td>
                        <td class="amount-column">₹ {{ number_format($prescription->advance) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="total-label">Balance</td>
                        <td class="amount-column">₹ {{ number_format($prescription->balance) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="section">
            <h2>Prescription Details</h2>
            <div class="prescription-grid">
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
                            <td>{{ $prescription->re_sph ?: '-' }}</td>
                            <td>{{ $prescription->re_cyl ?: '-' }}</td>
                            <td>{{ $prescription->re_axis ?: '-' }}</td>
                            <td>{{ $prescription->re_vision ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>LE</strong></td>
                            <td>{{ $prescription->le_sph ?: '-' }}</td>
                            <td>{{ $prescription->le_cyl ?: '-' }}</td>
                            <td>{{ $prescription->le_axis ?: '-' }}</td>
                            <td>{{ $prescription->le_vision ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>ADD</strong></td>
                            <td colspan="2">{{ $prescription->add_r ?: '-' }}</td>
                            <td colspan="2">{{ $prescription->add_l ?: '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($prescription->remarks)
        <div class="section">
            <h2>Remarks</h2>
            <p>{{ $prescription->remarks }}</p>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for mark as paid button
        document.querySelectorAll('form[action*="markAsPaid"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const confirmMsg = "Are you sure you want to mark this prescription as paid?";
                
                if (!confirm(confirmMsg)) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    });
</script>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .page-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
        display: inline-block;
    }
    
    .btn-primary {
        background-color: #4e73df;
        color: white;
        border: none;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }
    
    .btn-success {
        background-color: #10b981;
        color: white;
        border: none;
    }
    
    .btn-payment {
        background-color: #f59e0b;
        color: white;
        border: none;
    }
    
    .d-inline {
        display: inline-block;
    }
    
    .prescription-details {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .prescription-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        padding: 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .header-item {
        margin-bottom: 5px;
    }
    
    .section {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .section h2 {
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.25rem;
        color: #4a5568;
    }
    
    .items-table, .prescription-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .items-table th, .items-table td,
    .prescription-table th, .prescription-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .items-table th, .prescription-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #4a5568;
    }
    
    .amount-column {
        text-align: right;
    }
    
    .total-label {
        text-align: right;
        font-weight: 600;
    }
    
    .prescription-grid {
        overflow-x: auto;
    }
    
    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .status-pending {
        background-color: #ffeed9;
        color: #f59e0b;
    }
    
    .status-partial {
        background-color: #e0f2fe;
        color: #0284c7;
    }
    
    .status-completed {
        background-color: #dcfce7;
        color: #16a34a;
    }
</style>
@endsection 