<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'date',
        'customer_name',
        'mobile_number',
        'prescription_type',
        'frame_description',
        'frame_amount',
        'glass_description',
        'glass_amount',
        'goggle_description',
        'goggle_amount',
        'contact_lenses_description',
        'contact_lenses_amount',
        'solutions_description',
        'solutions_amount',
        're_sph',
        're_cyl',
        're_axis',
        're_vision',
        'le_sph',
        'le_cyl',
        'le_axis',
        'le_vision',
        'add_l',
        'add_r',
        'total',
        'advance',
        'balance',
        'payment_status',
        'remarks'
    ];

    protected $casts = [
        'frame_amount' => 'integer',
        'glass_amount' => 'integer',
        'goggle_amount' => 'integer',
        'contact_lenses_amount' => 'integer',
        'solutions_amount' => 'integer',
        'total' => 'integer',
        'advance' => 'integer',
        'balance' => 'integer',
        'date' => 'date',
        're_sph' => 'string',
        're_cyl' => 'string',
        're_axis' => 'string',
        're_vision' => 'string',
        'le_sph' => 'string',
        'le_cyl' => 'string',
        'le_axis' => 'string',
        'le_vision' => 'string',
        'add_l' => 'string',
        'add_r' => 'string'
    ];

    public static function generateInvoiceNumber()
    {
        $lastInvoice = self::latest()->first();
        $lastNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_no, 3)) : 0;
        return 'INV' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function setFrameAmountAttribute($value)
    {
        $this->attributes['frame_amount'] = $this->cleanAmount($value);
    }

    public function setGlassAmountAttribute($value)
    {
        $this->attributes['glass_amount'] = $this->cleanAmount($value);
    }

    public function setGoggleAmountAttribute($value)
    {
        $this->attributes['goggle_amount'] = $this->cleanAmount($value);
    }

    public function setContactLensesAmountAttribute($value)
    {
        $this->attributes['contact_lenses_amount'] = $this->cleanAmount($value);
    }

    public function setSolutionsAmountAttribute($value)
    {
        $this->attributes['solutions_amount'] = $this->cleanAmount($value);
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = $this->cleanAmount($value);
    }

    public function setAdvanceAttribute($value)
    {
        $this->attributes['advance'] = $this->cleanAmount($value);
    }

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $this->cleanAmount($value);
    }

    private function cleanAmount($value)
    {
        if (is_null($value)) return null;
        return (int) preg_replace('/[^0-9]/', '', $value);
    }
}
