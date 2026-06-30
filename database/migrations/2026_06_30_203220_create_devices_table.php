<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('device_type');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();

            $table->text('accessories');
            $table->text('physical_condition');

            $table->boolean('password_provided')->default(false);
            $table->string('device_password')->nullable();

            $table->timestamps();

            $table->index('device_type');
            $table->index('brand');
            $table->index('serial_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};