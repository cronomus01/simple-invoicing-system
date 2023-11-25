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
        Schema::create('invoice_total', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoice');
            $table->integer('discount')->nullable();
            $table->integer('vat')->nullable();
            $table->integer('grand_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_total');
    }
};
