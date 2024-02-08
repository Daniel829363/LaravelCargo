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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('trek_kod');
            $table->string('kod')->nullable();
            $table->double('weight')->nullable();
            $table->double('price')->nullable();
            $table->boolean('payment')->default('0');
            $table->timestamp('receipt_A')->nullable();
            $table->timestamp('dispatch_A')->nullable();
            $table->timestamp('receipt_B')->nullable();
            $table->timestamp('issue')->nullable();
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
