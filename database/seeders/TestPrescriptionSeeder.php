<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prescription;
use Carbon\Carbon;

class TestPrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test prescription with all the new fields
        Prescription::create([
            'invoice_no' => 'TEST001',
            'date' => Carbon::now(),
            'customer_name' => 'Test Customer',
            'mobile_number' => '1234567890',
            'prescription_type' => 'Dr.',
            'frame_description' => 'Test Frame',
            'frame_amount' => 1000,
            'glass_description' => 'Test Glass',
            'glass_amount' => 2000,
            'photo_description' => 'Test Photo',
            'photo_amount' => 500,
            'other_description' => 'Test Other',
            'other' => 300,
            're_sph' => 1.5,
            're_cyl' => 0.5,
            're_axis' => 90,
            're_vision' => '6/6',
            'le_sph' => 1.0,
            'le_cyl' => 0.75,
            'le_axis' => 85,
            'le_vision' => '6/6',
            'add_l' => 1.0,
            'add_r' => 1.0,
            'total' => 3800,
            'advance' => 1000,
            'balance' => 2800,
            'payment_status' => 'partial',
            'remarks' => 'Test remarks'
        ]);
    }
}
