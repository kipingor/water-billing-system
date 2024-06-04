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
        Schema::create('meter_billing_contacts', function (Blueprint $table) {
            $table->foreignId('meter_id')->constrained();
            $table->foreignId('billing_contact_id')->constrained();

            $table->primary(['meter_id', 'billing_contact_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_billing_contacts');
    }
};
