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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20)->unique();
            $table->foreignId('contact_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('owner_id')->constrained('users')->nullOnDelete();
            $table->enum('status', ['draft', 'sent', 'paid', 'canceled'])->default('draft');
            $table->date('sent_at')->nullable();
            $table->unsignedTinyInteger('expires_in_days')->default(5);
            $table->date('expiration_date')->virtualAs('sent_at + expires_in_days');
            $table->date('paid_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users');
            $table->date('canceled_at')->nullable();
            $table->foreignId('canceled_by')->nullable()->constrained('users');
            $table->decimal('sub_total', 10, 2);
            $table->unsignedTinyInteger('tax_percentage')->default(0);
            $table->decimal('tax_amount', 10, 2)->virtualAs('sub_total * tax_percentage / 100');
            $table->decimal('total', 10, 2)->virtualAs('sub_total + tax_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
