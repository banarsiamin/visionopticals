<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::query();

        // Apply invoice number search
        if ($request->has('invoice_no') && !empty($request->invoice_no)) {
            $query->where('invoice_no', 'like', "%{$request->invoice_no}%");
        }

        // Apply general search for customer name or mobile number
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%");
            });
        }

        // Apply payment status filter
        if ($request->has('payment_status') && !empty($request->payment_status)) {
            $query->where('payment_status', $request->payment_status);
        }

        // Apply date range filter
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('date', '>=', Carbon::parse($request->date_from));
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('date', '<=', Carbon::parse($request->date_to));
        }

        // Get paginated results
        $prescriptions = $query->latest()->paginate(10);

        return view('vision.admin.index', compact('prescriptions'));
    }

    public function view(Prescription $prescription)
    {
        return view('vision.admin.view', [
            'prescription' => $prescription,
            'viewMode' => true
        ]);
    }

    public function edit(Prescription $prescription)
    {
        return view('vision.admin.edit', [
            'prescription' => $prescription,
            'editMode' => true
        ]);
    }

    public function update(Request $request, Prescription $prescription)
    {
        $formData = $request->all();
        
        // Clean amount inputs to ensure they're integers
        $amountFields = [
            'frame_amount',
            'glass_amount',
            'photo_amount',
            'other',
            'total',
            'advance',
            'balance'
        ];
        
        foreach ($amountFields as $field) {
            if (isset($formData[$field])) {
                // Remove all non-numeric characters and convert to integer
                $value = preg_replace('/[^0-9]/', '', $formData[$field]);
                $formData[$field] = (int)$value;
            }
        }
        
        // Convert date format from d/m/Y to Y-m-d for database storage
        if (isset($formData['date'])) {
            try {
                $date = Carbon::createFromFormat('d/m/Y', $formData['date'])->format('Y-m-d');
                $formData['date'] = $date;
            } catch (\Exception $e) {
                // If date parsing fails, use current date
                $formData['date'] = Carbon::now()->format('Y-m-d');
            }
        }
        
        // Update payment status based on advance amount
        if (isset($formData['advance']) && isset($formData['total'])) {
            if ($formData['advance'] >= $formData['total']) {
                $formData['payment_status'] = 'completed';
            } elseif ($formData['advance'] > 0) {
                $formData['payment_status'] = 'partial';
            } else {
                $formData['payment_status'] = 'pending';
            }
        }
        
        $request->merge($formData);
        
        $validated = $request->validate([
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'prescription_type' => 'required|string|in:Dr.,N,R,P',
            'frame_description' => 'nullable|string',
            'frame_amount' => 'nullable|integer|min:0',
            'glass_description' => 'nullable|string',
            'glass_amount' => 'nullable|integer|min:0',
            'photo_description' => 'nullable|string',
            'photo_amount' => 'nullable|integer|min:0',
            'other_description' => 'nullable|string',
            'other' => 'nullable|integer|min:0',
            're_sph' => 'nullable|string',
            're_cyl' => 'nullable|string',
            're_axis' => 'nullable|string',
            're_vision' => 'nullable|string',
            'le_sph' => 'nullable|string',
            'le_cyl' => 'nullable|string',
            'le_axis' => 'nullable|string',
            'le_vision' => 'nullable|string',
            'add_l' => 'nullable|string',
            'add_r' => 'nullable|string',
            'total' => 'required|integer|min:0',
            'advance' => 'nullable|integer|min:0',
            'balance' => 'nullable|integer|min:0',
            'payment_status' => 'required|string|in:pending,partial,completed',
            'remarks' => 'nullable|string',
        ]);

        $prescription->update($validated);

        return redirect()->route('admin.prescriptions.view', $prescription)
            ->with('success', 'Prescription updated successfully');
    }

    public function destroy(Prescription $prescription)
    {
        try {
            DB::beginTransaction();

            // Delete prescription items
            $prescription->items()->delete();
            
            // Delete prescription
            $prescription->delete();

            DB::commit();

            return redirect()
                ->route('admin.prescriptions.index')
                ->with('success', 'Prescription deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Failed to delete prescription. Please try again.');
        }
    }

    /**
     * Mark a prescription as paid (set advance to match total).
     */
    public function markAsPaid(Prescription $prescription)
    {
        // Set advance amount equal to total and update payment status
        $prescription->update([
            'advance' => $prescription->total,
            'balance' => 0,
            'payment_status' => 'completed'
        ]);

        return redirect()
            ->route('admin.prescriptions.view', $prescription)
            ->with('success', 'Payment marked as completed for Invoice #' . $prescription->invoice_no);
    }
} 