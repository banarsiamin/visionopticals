<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pending Payment Sample
        Prescription::create([
            'invoice_no' => 'INV000001',
            'date' => Carbon::now()->subDays(10),
            'customer_name' => 'John Doe',
            'mobile_number' => '9876543210',
            'prescription_type' => 'Dr.',
            'frame_description' => 'Ray-Ban Square Frame',
            'frame_amount' => 2500,
            'glass_description' => 'Anti-Glare Glass',
            'glass_amount' => 3500,
            'photo_description' => null,
            'photo_amount' => 0,
            'other_description' => null,
            'other' => 0,
            're_sph' => '-1.50',
            're_cyl' => '-0.50',
            're_axis' => '90',
            're_vision' => '6/6',
            'le_sph' => '-1.25',
            'le_cyl' => '-0.50',
            'le_axis' => '90',
            'le_vision' => '6/6',
            'add_r' => '0',
            'add_l' => '0',
            'total' => 6000,
            'advance' => 0,
            'balance' => 6000,
            'payment_status' => 'pending',
            'remarks' => 'Near Vision'
        ]);

        // Partial Payment Sample
        Prescription::create([
            'invoice_no' => 'INV000002',
            'date' => Carbon::now()->subDays(5),
            'customer_name' => 'Jane Smith',
            'mobile_number' => '8765432109',
            'prescription_type' => 'N',
            'frame_description' => 'Titan Full Rim',
            'frame_amount' => 3000,
            'glass_description' => 'Blue Cut Glass',
            'glass_amount' => 4000,
            'photo_description' => 'Photochromic',
            'photo_amount' => 1500,
            'other_description' => null,
            'other' => 0,
            're_sph' => '+1.00',
            're_cyl' => '-0.25',
            're_axis' => '180',
            're_vision' => '6/6',
            'le_sph' => '+1.25',
            'le_cyl' => '-0.25',
            'le_axis' => '180',
            'le_vision' => '6/6',
            'add_r' => '1.5',
            'add_l' => '1.5',
            'total' => 8500,
            'advance' => 4000,
            'balance' => 4500,
            'payment_status' => 'partial',
            'remarks' => 'Progressive'
        ]);

        // Completed Payment Sample
        Prescription::create([
            'invoice_no' => 'INV000003',
            'date' => Carbon::now()->subDays(2),
            'customer_name' => 'Robert Johnson',
            'mobile_number' => '7654321098',
            'prescription_type' => 'R',
            'frame_description' => 'Oakley Sports Frame',
            'frame_amount' => 5000,
            'glass_description' => 'High Index Glass',
            'glass_amount' => 6000,
            'photo_description' => null,
            'photo_amount' => 0,
            'other_description' => 'Lens Cleaning Kit',
            'other' => 500,
            're_sph' => '-3.50',
            're_cyl' => '-1.00',
            're_axis' => '45',
            're_vision' => '6/6',
            'le_sph' => '-3.25',
            'le_cyl' => '-1.25',
            'le_axis' => '40',
            'le_vision' => '6/6',
            'add_r' => '0',
            'add_l' => '0',
            'total' => 11500,
            'advance' => 11500,
            'balance' => 0,
            'payment_status' => 'completed',
            'remarks' => 'Distance'
        ]);

        // Another Pending Payment
        Prescription::create([
            'invoice_no' => 'INV000004',
            'date' => Carbon::now()->subDay(),
            'customer_name' => 'Meera Patel',
            'mobile_number' => '9988776655',
            'prescription_type' => 'P',
            'frame_description' => 'Vincent Chase Rimless',
            'frame_amount' => 1800,
            'glass_description' => 'Zero Power Computer Glass',
            'glass_amount' => 2200,
            'photo_description' => null,
            'photo_amount' => 0,
            'other_description' => null,
            'other' => 0,
            're_sph' => '0',
            're_cyl' => '0',
            're_axis' => '0',
            're_vision' => '6/6',
            'le_sph' => '0',
            'le_cyl' => '0',
            'le_axis' => '0',
            'le_vision' => '6/6',
            'add_r' => '0',
            'add_l' => '0',
            'total' => 4000,
            'advance' => 0,
            'balance' => 4000,
            'payment_status' => 'pending',
            'remarks' => 'Computer Vision'
        ]);

        // Another Partial Payment
        Prescription::create([
            'invoice_no' => 'INV000005',
            'date' => Carbon::now(),
            'customer_name' => 'Raj Kumar',
            'mobile_number' => '7788990011',
            'prescription_type' => 'Dr.',
            'frame_description' => 'Lenskart Air',
            'frame_amount' => 1200,
            'glass_description' => 'Bifocal Glass',
            'glass_amount' => 3800,
            'photo_description' => null,
            'photo_amount' => 0,
            'other_description' => 'Frame Case',
            'other' => 300,
            're_sph' => '+2.50',
            're_cyl' => '0',
            're_axis' => '0',
            're_vision' => '6/9',
            'le_sph' => '+2.75',
            'le_cyl' => '0',
            'le_axis' => '0', 
            'le_vision' => '6/9',
            'add_r' => '2.0',
            'add_l' => '2.0',
            'total' => 5300,
            'advance' => 2000,
            'balance' => 3300,
            'payment_status' => 'partial',
            'remarks' => 'Bifocal'
        ]);
    }
} 