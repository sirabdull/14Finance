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
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('transaction_reference', 50)->unique();
            $table->enum('type', ['credit', 'debit']);
            $table->enum('category', ['transfer', 'bill_payment', 'deposit', 'withdrawal']);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->string('recipient_account', 20)->nullable();
            $table->string('recipient_name', 255)->nullable();
            $table->string('narration', 255)->nullable();
            $table->string('bill_type', 50)->nullable();
            $table->string('bill_reference', 100)->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
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
