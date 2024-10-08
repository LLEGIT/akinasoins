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
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->boolean('has_disorder_type')->default(false);
            $table->boolean('has_medical_history')->default(false);
            $table->boolean('physical_activity')->default(false);
            $table->boolean('smoker')->default(false);
            $table->boolean('drinks_alcohol')->default(false);
            $table->boolean('has_allergies')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
