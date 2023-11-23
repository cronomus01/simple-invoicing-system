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
        Schema::dropIfExists('payment');
        Schema::create('payment', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->foreignId('invoice_id')->constrained('invoice');
            $table->integer('amount_paid');
            $table->string('type_of_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropForeign('invoice_id');
        Schema::dropIfExists('payment');
    }
};
