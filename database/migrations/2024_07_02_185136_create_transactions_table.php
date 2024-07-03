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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_tenant');
            $table->foreign('fk_tenant')->references('id')->on('tenants');
            $table->unsignedBigInteger('fk_order');
            $table->foreign('fk_order')->references('id')->on('orders');
            $table->string('mpesa_transaction_id')->nullable();
            $table->string('cash_transaction_id')->nullable();
            $table->enum('payment_method', ['cash', 'mpesa']);
            $table->decimal('amount', 10, 2);
            $table->string('active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
