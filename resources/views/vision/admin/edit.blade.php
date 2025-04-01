@extends('vision.layouts.app')

@section('content')
<div class="container">
    <div class="admin-header">
        <h1>Edit Prescription</h1>
        <div class="header-actions">
            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <form action="{{ route('admin.prescriptions.update', $prescription) }}" method="POST" class="prescription-form">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2>Customer Information</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="invoice_no">Invoice Number</label>
                    <input type="text" id="invoice_no" name="invoice_no" value="{{ old('invoice_no', $prescription->invoice_no) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $prescription->customer_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $prescription->mobile_number) }}" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" id="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($prescription->date)->format('d/m/Y')) }}" required>
                </div>
                <div class="form-group">
                    <label for="prescription_type">Prescription Type</label>
                    <select id="prescription_type" name="prescription_type" required>
                        <option value="Dr." {{ old('prescription_type', $prescription->prescription_type) == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                        <option value="N" {{ old('prescription_type', $prescription->prescription_type) == 'N' ? 'selected' : '' }}>N</option>
                        <option value="R" {{ old('prescription_type', $prescription->prescription_type) == 'R' ? 'selected' : '' }}>R</option>
                        <option value="P" {{ old('prescription_type', $prescription->prescription_type) == 'P' ? 'selected' : '' }}>P</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Prescription Items</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="frame_description">Frame Description</label>
                    <input type="text" id="frame_description" name="frame_description" value="{{ old('frame_description', $prescription->frame_description) }}">
                </div>
                <div class="form-group">
                    <label for="frame_amount">Frame Amount</label>
                    <input type="text" id="frame_amount" name="frame_amount" value="{{ old('frame_amount', $prescription->frame_amount) }}" class="amount-input">
                </div>
                <div class="form-group">
                    <label for="glass_description">Glass Description</label>
                    <input type="text" id="glass_description" name="glass_description" value="{{ old('glass_description', $prescription->glass_description) }}">
                </div>
                <div class="form-group">
                    <label for="glass_amount">Glass Amount</label>
                    <input type="text" id="glass_amount" name="glass_amount" value="{{ old('glass_amount', $prescription->glass_amount) }}" class="amount-input">
                </div>
                <div class="form-group">
                    <label for="photo_description">Photo Description</label>
                    <input type="text" id="photo_description" name="photo_description" value="{{ old('photo_description', $prescription->photo_description) }}">
                </div>
                <div class="form-group">
                    <label for="photo_amount">Photo Amount</label>
                    <input type="text" id="photo_amount" name="photo_amount" value="{{ old('photo_amount', $prescription->photo_amount) }}" class="amount-input">
                </div>
                <div class="form-group">
                    <label for="other_description">Other Description</label>
                    <input type="text" id="other_description" name="other_description" value="{{ old('other_description', $prescription->other_description) }}">
                </div>
                <div class="form-group">
                    <label for="other">Other Amount</label>
                    <input type="text" id="other" name="other" value="{{ old('other', $prescription->other) }}" class="amount-input">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Eye Prescription</h2>
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
                            <td><input type="text" name="re_sph" value="{{ old('re_sph', $prescription->re_sph) }}"></td>
                            <td><input type="text" name="re_cyl" value="{{ old('re_cyl', $prescription->re_cyl) }}"></td>
                            <td><input type="text" name="re_axis" value="{{ old('re_axis', $prescription->re_axis) }}"></td>
                            <td><input type="text" name="re_vision" value="{{ old('re_vision', $prescription->re_vision) }}"></td>
                        </tr>
                        <tr>
                            <td><strong>LE</strong></td>
                            <td><input type="text" name="le_sph" value="{{ old('le_sph', $prescription->le_sph) }}"></td>
                            <td><input type="text" name="le_cyl" value="{{ old('le_cyl', $prescription->le_cyl) }}"></td>
                            <td><input type="text" name="le_axis" value="{{ old('le_axis', $prescription->le_axis) }}"></td>
                            <td><input type="text" name="le_vision" value="{{ old('le_vision', $prescription->le_vision) }}"></td>
                        </tr>
                        <tr>
                            <td><strong>ADD</strong></td>
                            <td colspan="2">R: <input type="text" name="add_r" value="{{ old('add_r', $prescription->add_r) }}"></td>
                            <td colspan="2">L: <input type="text" name="add_l" value="{{ old('add_l', $prescription->add_l) }}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-section">
            <h2>Payment Information</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="total">Total Amount</label>
                    <input type="text" id="total" name="total" value="{{ old('total', $prescription->total) }}" class="amount-input" readonly>
                </div>
                <div class="form-group">
                    <label for="advance">Advance Amount</label>
                    <input type="text" id="advance" name="advance" value="{{ old('advance', $prescription->advance) }}" class="amount-input">
                </div>
                <div class="form-group">
                    <label for="balance">Balance Amount</label>
                    <input type="text" id="balance" name="balance" value="{{ old('balance', $prescription->balance) }}" class="amount-input" readonly>
                </div>
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status" required>
                        <option value="pending" {{ old('payment_status', $prescription->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="partial" {{ old('payment_status', $prescription->payment_status) == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="completed" {{ old('payment_status', $prescription->payment_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Additional Notes</h2>
            <div class="form-group">
                <textarea name="remarks" rows="4">{{ old('remarks', $prescription->remarks) }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Prescription</button>
        </div>
    </form>
</div>

<style>
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .prescription-form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .form-section h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-group label {
        font-weight: 600;
        color: #666;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .prescription-grid {
        overflow-x: auto;
    }

    .prescription-table {
        width: 100%;
        border-collapse: collapse;
    }

    .prescription-table th,
    .prescription-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .prescription-table input {
        width: 100%;
        padding: 6px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #4e73df;
    }

    .btn-secondary {
        background-color: #6c757d;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format currency inputs
        const formatCurrency = (value) => {
            if (!value) return '';
            // Convert paise to rupees for display (divide by 100)
            const rupees = value / 100;
            return '₹ ' + rupees.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        };

        // Extract number from currency string and convert to paise
        const extractNumber = (value) => {
            if (!value) return 0;
            // Remove currency symbol, commas and convert to float
            const numericValue = parseFloat(value.replace(/[^\d.-]/g, '')) || 0;
            // If input contains decimal, multiply by 100 to convert to paise
            if (value.includes('.')) {
                return Math.round(numericValue * 100);
            }
            // If no decimal, assume it's already in whole numbers
            return Math.round(numericValue);
        };

        // Format all amount inputs
        document.querySelectorAll('.amount-input').forEach(input => {
            // Format initial value
            if (input.value) {
                const numValue = parseInt(input.value);
                input.value = formatCurrency(numValue);
            }
            
            // Handle input
            input.addEventListener('input', function(e) {
                let value = this.value.replace(/[^\d.]/g, '');
                
                // Handle decimal points
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                
                const numValue = parseFloat(value) || 0;
                this.value = value;
                calculateTotals();
            });

            // Format on blur
            input.addEventListener('blur', function() {
                const value = extractNumber(this.value);
                if (value > 0) {
                    this.value = formatCurrency(value);
                } else {
                    this.value = '';
                }
                calculateTotals();
            });
        });
        
        // Calculate totals function
        function calculateTotals() {
            const frameAmount = extractNumber(document.getElementById('frame_amount').value);
            const glassAmount = extractNumber(document.getElementById('glass_amount').value);
            const photoAmount = extractNumber(document.getElementById('photo_amount').value);
            const otherAmount = extractNumber(document.getElementById('other').value);
            
            const totalAmount = frameAmount + glassAmount + photoAmount + otherAmount;
            const advanceAmount = extractNumber(document.getElementById('advance').value);
            const balanceAmount = totalAmount - advanceAmount;
            
            document.getElementById('total').value = formatCurrency(totalAmount);
            document.getElementById('balance').value = formatCurrency(balanceAmount);
            
            // Update payment status automatically
            const paymentStatus = document.getElementById('payment_status');
            if (advanceAmount >= totalAmount) {
                paymentStatus.value = 'completed';
            } else if (advanceAmount > 0) {
                paymentStatus.value = 'partial';
            } else {
                paymentStatus.value = 'pending';
            }

            // Add hidden inputs for the actual values
            updateOrCreateHiddenInput('total', totalAmount);
            updateOrCreateHiddenInput('advance', advanceAmount);
            updateOrCreateHiddenInput('balance', balanceAmount);
            updateOrCreateHiddenInput('frame_amount', frameAmount);
            updateOrCreateHiddenInput('glass_amount', glassAmount);
            updateOrCreateHiddenInput('photo_amount', photoAmount);
            updateOrCreateHiddenInput('other', otherAmount);
        }

        // Helper function to update or create hidden inputs
        function updateOrCreateHiddenInput(name, value) {
            let hiddenInput = document.querySelector(`input[name="${name}_actual"]`);
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = name + '_actual';
                document.querySelector('form').appendChild(hiddenInput);
            }
            hiddenInput.value = value;
        }

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const amountInputs = document.querySelectorAll('.amount-input');
            amountInputs.forEach(input => {
                const actualValue = extractNumber(input.value);
                input.value = actualValue;
            });
        });
        
        // Initial calculation
        calculateTotals();
    });
</script>
@endsection 