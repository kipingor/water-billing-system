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
        Schema::create('liabilities', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->enum('type', ['loan', 'mortgage', 'accounts_payable', 'other']);
            $table->decimal('amount', 12, 2);
            $table->date('start_date');
            $table->date('due_date')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->enum('payment_frequency', ['one_time', 'monthly', 'quarterly', 'annually'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liabilities');
    }
};
