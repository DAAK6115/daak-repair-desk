<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('client_type')->default('Particulier');

            $table->timestamps();

            $table->index('phone');
            $table->index('full_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};