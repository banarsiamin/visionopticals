<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    public function index()
    {
        // Generate invoice number (4 digit sequence)
        $lastInvoice = Prescription::orderBy('id', 'desc')->first();
        
        $sequence = $lastInvoice ? intval($lastInvoice->id) + 1 : 1;
        $invoiceNo = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return view('vision.partials.content', compact('invoiceNo'));
    }

    public function store(Request $request)
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
        
        $request->merge($formData);
        
        // echo "<PRE>";print_r($request);die;

        // echo "<PRE>";print_r($validated);
        // echo "<PRE>";print_r($_REQUEST);die;
        $validated = $request->validate([
            'invoice_no' => 'required|string|unique:prescriptions',
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
            'remarks' => 'nullable|string',
        ]);
        
        // Calculate payment status based on advance amount
        if (($validated['advance'] ?? 0) >= $validated['total']) {
            $validated['payment_status'] = 'completed';
        } elseif (($validated['advance'] ?? 0) > 0) {
            $validated['payment_status'] = 'partial';
        } else {
            $validated['payment_status'] = 'pending';
        }

        $prescription = Prescription::create($validated);

        if ($request->has('send_whatsapp')) {
            return $this->sendWhatsApp($prescription);
        }

        // Redirect to view page
        return redirect()->route('prescription.print', $prescription)
            ->with('success', 'Prescription #' . $prescription->invoice_no . ' created successfully! 🎉');
    }

    public function edit(Prescription $prescription)
    {
        // return view('vision.index', [
        //     'prescription' => $prescription,
        //     'editMode' => true,
        //     'invoiceNo' => $prescription->invoice_no
        // ]);
        // Generate a new invoice number for any new prescriptions
        $lastInvoice = Prescription::orderBy('id', 'desc')->first();
        $sequence = $lastInvoice ? intval($lastInvoice->id) + 1 : 1;
        $invoiceNo = str_pad($sequence, 4, '0', STR_PAD_LEFT);
        
        // Return the index view but with the prescription data for viewing
        return view('vision.partials.content', [
            'invoiceNo' => $invoiceNo,
            'viewMode' => false,
            'prescription' => $prescription,
            'pp' => '1'
        ]);
    }
    public function print(Prescription $prescription)
    {
        // Generate a new invoice number for any new prescriptions
        $lastInvoice = Prescription::orderBy('id', 'desc')->first();
        $sequence = $lastInvoice ? intval($lastInvoice->id) + 1 : 1;
        $invoiceNo = str_pad($sequence, 4, '0', STR_PAD_LEFT);
        
        // Return the index view but with the prescription data for viewing
        return view('vision.partials.content', [
            'invoiceNo' => $invoiceNo,
            'viewMode' => false,
            'prescription' => $prescription,
            'pp' => '1'
        ]);
    }

    public function sendWhatsApp(Prescription $prescription)
    {
        // Get the customer's WhatsApp number
        $phone = $prescription->mobile_number;
        
        // Create a URL to the prescription view
        $prescriptionUrl = route('prescription.print', $prescription);
        
        // Prepare the message text
        $message = "Thank you for choosing Vision Opticals. Your prescription #" . $prescription->invoice_no . " is ready. View details here: " . $prescriptionUrl;
        
        // Encode the message for WhatsApp
        $encodedMessage = urlencode($message);
        
        // Create the WhatsApp URL
        $whatsappUrl = "https://wa.me/{$phone}?text={$encodedMessage}";
        
        // Redirect to WhatsApp
        return redirect()->away($whatsappUrl);
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
            'remarks' => 'nullable|string',
        ]);
        
        // Calculate payment status based on advance amount
        if (($validated['advance'] ?? 0) >= $validated['total']) {
            $validated['payment_status'] = 'completed';
        } elseif (($validated['advance'] ?? 0) > 0) {
            $validated['payment_status'] = 'partial';
        } else {
            $validated['payment_status'] = 'pending';
        }
        
        // echo "<PRE>";print_r($validated);
        // echo "<PRE>";print_r($_REQUEST);die;
        $prescription->update($validated);

        if ($request->has('send_whatsapp')) {
            return $this->sendWhatsApp($prescription);
        }

        // Redirect to view page
        return redirect()->route('prescription.print', $prescription)
            ->with('success', 'Prescription #' . $prescription->invoice_no . ' updated successfully! 🎉');
    }
}
