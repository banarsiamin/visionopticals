<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn([
                'glasses_description',
                'glasses_amount',
                'goggle_description',
                'goggle_amount',
                'contact_lenses_description',
                'contact_lenses_amount',
                'solutions_description',
                'solutions_amount',
                'total_amount',
                'advance_amount',
                'balance_amount',
            ]);

            // Add new columns
            $table->string('glass_description')->nullable();
            $table->integer('glass_amount')->nullable();
            $table->string('photo_description')->nullable();
            $table->integer('photo_amount')->nullable();
            $table->string('other_description')->nullable();
            $table->integer('other')->nullable();
            $table->integer('total');
            $table->integer('advance')->nullable();
            $table->integer('balance')->nullable();
            
            // Convert frame_amount to integer
            $table->integer('frame_amount')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn([
                'glass_description',
                'glass_amount',
                'photo_description',
                'photo_amount',
                'other_description',
                'other',
                'total',
                'advance',
                'balance',
            ]);

            // Add old columns back
            $table->string('glasses_description')->nullable();
            $table->decimal('glasses_amount', 10, 2)->nullable();
            $table->string('goggle_description')->nullable();
            $table->decimal('goggle_amount', 10, 2)->nullable();
            $table->string('contact_lenses_description')->nullable();
            $table->decimal('contact_lenses_amount', 10, 2)->nullable();
            $table->string('solutions_description')->nullable();
            $table->decimal('solutions_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('advance_amount', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            
            // Convert frame_amount back to decimal
            $table->decimal('frame_amount', 10, 2)->nullable()->change();
        });
    }
};
