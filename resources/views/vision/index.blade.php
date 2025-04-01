@extends('vision.layouts.app')

@section('title', isset($prescription) ? 'Edit Prescription #' . $prescription->invoice_no : 'New Prescription')

@section('content')
    @if(session('success'))
        @php 
            $success = session('success'); 
            $lastPrescriptionId = session('lastPrescriptionId');
            $lastPrescription = null;
            if ($lastPrescriptionId) {
                $lastPrescription = App\Models\Prescription::find($lastPrescriptionId);
            }
        @endphp
    @endif
    
    @include('vision.partials.content', [
        'success' => $success ?? null,
        'lastPrescription' => $lastPrescription ?? null
    ])
@endsection