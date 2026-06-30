<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('device_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('receipt_number')->unique();

            $table->text('declared_issue');

            $table->text('diagnosis')->nullable();
            $table->text('proposed_solution')->nullable();

            $table->decimal('diagnostic_fee', 12, 2)->default(0);
            $table->decimal('estimated_cost', 12, 2)->nullable();

            $table->string('status')->default('Déposé');

            $table->timestamp('deposit_date')->nullable();
            $table->timestamp('expected_delivery_date')->nullable();
            $table->timestamp('withdrawal_date')->nullable();

            $table->string('dolibarr_invoice_ref')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('receipt_number');
            $table->index('deposit_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};