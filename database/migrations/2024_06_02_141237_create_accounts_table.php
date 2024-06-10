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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->string('code', 10)->unique();
            $table->foreignId('owner')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('industry_id')->constrained('industries');
            $table->foreignId('account_type_id')->constrained('account_types');
            $table->foreignId('source_id')->constrained('sources');
            $table->foreignId('account_manager_id')->constrained('users');
            $table->enum('status', ['active', 'inactive', 'suspended']);
            $table->string('country');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('tax_number', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->unsignedTinyInteger('rating')->default(0);
            $table->json('social_media')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
