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
        Schema::create('banking_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->string('description');
            $table->string('account_number');
            $table->string('counter_account_number')->nullable();
            $table->string('code');
            $table->string('debit_credit');
            $table->decimal('amount', 8, 2);
            $table->string('transaction_type');
            $table->text('notes')->nullable();
            $table->decimal('balance_after_transaction', 8, 2);
            $table->string('tag')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banking_transactions');
    }
};
