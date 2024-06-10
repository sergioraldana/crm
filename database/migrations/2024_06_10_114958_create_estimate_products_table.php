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
        Schema::create('estimate_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->text('description'); // Descripción breve del servicio o producto
            $table->enum('estimated_time_unit', ['minutes', 'hours', 'days', 'weeks', 'months', 'years', 'one-time']);
            $table->unsignedTinyInteger('estimated_quantity')->default(1); // 1, 2, 3, ..., 12
            $table->unsignedTinyInteger('estimated_time')->default(1); // 1, 2, 3, ..., 12
            $table->decimal('estimated_price', 10, 2); // 9999999.99
            $table->longText('final_terms_and_conditions')->nullable(); // Términos y condiciones del servicio o producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimate_service');
    }
};
