@extends('vision.layouts.app')

@section('content')
<div class="container">
    <div class="admin-header">
        <h1>Prescriptions Management</h1>
        <div class="admin-actions">
            <a href="{{ route('prescription.index') }}" class="btn btn-primary">New Prescription</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="admin-filters">
        <form action="{{ route('admin.prescriptions.index') }}" method="GET" class="filter-form">
            <div class="filter-row">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Search by name or mobile..." value="{{ request('search') }}">
                </div>
                
                <div class="search-box">
                    <input type="text" name="invoice_no" placeholder="Search by invoice #..." value="{{ request('invoice_no') }}">
                </div>
                
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-outline">Reset</a>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <label for="payment_status">Payment Status:</label>
                    <select name="payment_status" id="payment_status">
                        <option value="">All Payments</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="completed" {{ request('payment_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="date_from">From:</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
                </div>
                
                <div class="filter-group">
                    <label for="date_to">To:</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
                </div>
                
                <button type="submit" class="btn btn-secondary">Apply Filters</button>
            </div>
        </form>
    </div>
    
    <div class="prescriptions-table">
        <table>
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Mobile Number</th>
                    <th>Total Amount</th>
                    <th>Advance</th>
                    <th>Balance</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->invoice_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($prescription->date)->format('d/m/Y') }}</td>
                    <td>{{ $prescription->customer_name }}</td>
                    <td>{{ $prescription->mobile_number }}</td>
                    <td class="amount">₹ {{ number_format($prescription->total / 100, 2) }}</td>
                    <td class="amount">₹ {{ number_format($prescription->advance / 100, 2) }}</td>
                    <td class="amount">₹ {{ number_format($prescription->balance / 100, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $prescription->payment_status }}">
                            {{ ucfirst($prescription->payment_status) }}
                        </span>
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.prescriptions.view', $prescription) }}" class="btn-sm btn-view">View</a>
                        <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn-sm btn-edit">Edit</a>
                        <a href="{{ route('prescription.print', $prescription) }}" target="_blank" class="btn-sm btn-print">Print</a>
                        
                        @if($prescription->payment_status != 'completed')
                            <form action="{{ route('admin.prescriptions.markAsPaid', $prescription) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-sm btn-payment">Mark Paid</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="empty-table">No prescriptions found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination">
            {{ $prescriptions->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
    }

    .admin-header h1 {
        font-size: 24px;
        color: #1f2937;
        margin: 0;
    }
    
    .admin-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-primary {
        background-color: #4f46e5;
        color: white;
    }

    .btn-primary:hover {
        background-color: #4338ca;
    }

    .btn-secondary {
        background-color: #4b5563;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #374151;
    }

    .btn-danger {
        background-color: #dc2626;
        color: white;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
    }

    .btn-outline {
        border: 1px solid #d1d5db;
        background-color: white;
        color: #4b5563;
    }

    .btn-outline:hover {
        background-color: #f3f4f6;
    }
    
    .filter-form {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    
    .filter-row {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .search-box {
        flex: 1;
    }
    
    .search-box input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 14px;
    }

    .search-box input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 1px #4f46e5;
    }
    
    .prescriptions-table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        background-color: #f8fafc;
        padding: 12px 16px;
        text-align: left;
        font-weight: 600;
        color: #4b5563;
        border-bottom: 1px solid #e5e7eb;
    }
    
    td {
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
        color: #1f2937;
    }

    td.amount {
        text-align: right;
        font-family: monospace;
        font-size: 14px;
    }
    
    tr:hover {
        background-color: #f8fafc;
    }
    
    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    .status-pending {
        background-color: #fef3c7;
        color: #d97706;
    }
    
    .status-partial {
        background-color: #e0f2fe;
        color: #0369a1;
    }
    
    .status-completed {
        background-color: #dcfce7;
        color: #15803d;
    }
    
    .actions {
        white-space: nowrap;
    }

    .btn-sm {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        margin-right: 4px;
    }

    .btn-view {
        background-color: #e0f2fe;
        color: #0369a1;
    }

    .btn-edit {
        background-color: #fef3c7;
        color: #d97706;
    }

    .btn-print {
        background-color: #f3e8ff;
        color: #7e22ce;
    }

    .btn-payment {
        background-color: #dcfce7;
        color: #15803d;
        border: none;
        cursor: pointer;
    }

    .empty-table {
        text-align: center;
        color: #6b7280;
        padding: 32px !important;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        padding: 20px;
    }

    .pagination nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .pagination span, .pagination a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 35px;
        height: 35px;
        margin: 0 3px;
        padding: 0 10px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        color: #4b5563;
        background-color: white;
    }

    .pagination span.dots {
        border: none;
        padding: 0 5px;
    }

    .pagination .active {
        background-color: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }

    .pagination a:hover {
        background-color: #f3f4f6;
        border-color: #d1d5db;
    }

    .pagination span.disabled {
        color: #9ca3af;
        cursor: not-allowed;
        background-color: #f9fafb;
    }

    .pagination svg {
        width: 20px;
        height: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .filter-row {
            flex-direction: column;
        }
        
        .search-box {
            width: 100%;
        }
        
        .prescriptions-table {
            overflow-x: auto;
        }
        
        table {
            min-width: 1000px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for payment forms
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
@endsection 