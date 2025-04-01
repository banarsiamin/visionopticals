<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->date('date');
            $table->string('customer_name');
            $table->string('mobile_number');
            $table->string('prescription_type');
            
            // Frame details
            $table->string('frame_description')->nullable();
            $table->decimal('frame_amount', 10, 2)->nullable();
            
            // Glasses details
            $table->string('glasses_description')->nullable();
            $table->decimal('glasses_amount', 10, 2)->nullable();
            
            // Goggle details
            $table->string('goggle_description')->nullable();
            $table->decimal('goggle_amount', 10, 2)->nullable();
            
            // Contact Lenses details
            $table->string('contact_lenses_description')->nullable();
            $table->decimal('contact_lenses_amount', 10, 2)->nullable();
            
            // Solutions details
            $table->string('solutions_description')->nullable();
            $table->decimal('solutions_amount', 10, 2)->nullable();
            
            // Right Eye (RE) details
            $table->decimal('re_sph', 5, 2)->nullable();
            $table->decimal('re_cyl', 5, 2)->nullable();
            $table->integer('re_axis')->nullable();
            $table->string('re_vision')->nullable();
            
            // Left Eye (LE) details
            $table->decimal('le_sph', 5, 2)->nullable();
            $table->decimal('le_cyl', 5, 2)->nullable();
            $table->integer('le_axis')->nullable();
            $table->string('le_vision')->nullable();
            
            // ADD details
            $table->decimal('add_l', 5, 2)->nullable();
            $table->decimal('add_r', 5, 2)->nullable();
            
            // Payment details
            $table->decimal('total_amount', 10, 2);
            $table->decimal('advance_amount', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->string('payment_status')->default('pending');
            
            // Remarks
            $table->text('remarks')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}; 