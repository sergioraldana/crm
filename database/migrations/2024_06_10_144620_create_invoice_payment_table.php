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
        Schema::create('invoice_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('reference', 50)->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->foreignId('received_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payment');
    }
};
