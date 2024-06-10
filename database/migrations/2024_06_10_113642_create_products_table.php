<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del servicio o producto
            $table->string('code', 10)->unique(); // Código del servicio o producto
            $table->enum('type', ['product', 'service', 'subscription', 'other']);
            $table->enum('category', ['development', 'design', 'installation', 'maintenance', 'support', 'training', 'other']);
            $table->text('description'); // Descripción breve del servicio o producto
            $table->enum('recommended_time_unit', ['minutes', 'hours', 'days', 'weeks', 'months', 'years', 'one-time']);
            $table->unsignedTinyInteger('recommended_quantity')->default(1); // 1, 2, 3, ..., 12
            $table->unsignedTinyInteger('recommended_time')->default(1); // 1, 2, 3, ..., 12
            $table->decimal('recommended_price', 10, 2); // 9999999.99
            $table->longText('standard_terms_and_conditions')->nullable(); // Términos y condiciones del servicio o producto
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
