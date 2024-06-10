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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20)->unique();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['draft', 'sent', 'accepted', 'rejected', 'canceled'])->default('draft');
            $table->unsignedTinyInteger('expires_in_days')->default(30);
            $table->date('sent_at')->nullable();
            $table->date('expiration_date');
            $table->date('accepted_at')->nullable();
            $table->foreignId('accepted_by')->nullable()->constrained('users');
            $table->date('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users');
            $table->date('canceled_at')->nullable();
            $table->foreignId('canceled_by')->nullable()->constrained('users');
            $table->decimal('sub_total', 10, 2);
            $table->unsignedTinyInteger('tax_percentage')->default(0);
            $table->decimal('tax_amount', 10, 2)->virtualAs('sub_total * tax_percentage / 100');
            $table->decimal('total', 10, 2)->virtualAs('sub_total + tax_amount');
            $table->unsignedTinyInteger('advance_percentage')->default(50);
            $table->decimal('advance_amount', 10, 2)->virtualAs('total * advance_percentage / 100');
            $table->decimal('balance', 10, 2)->virtualAs('total - advance_amount');
            $table->enum('payment_frequency', ['one-time', 'weekly', 'monthly', 'quarterly', 'yearly']);
            $table->unsignedTinyInteger('payment_period')->default(1);
            $table->decimal('payment_amount', 10, 2)->virtualAs('advance_amount / payment_period');
            $table->date('first_payment_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->date('next_payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
