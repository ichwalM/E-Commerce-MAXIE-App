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
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index(); // No unique constraint here slightly safer for retry logic, but unique generally good to prevent spam. 
            $table->string('password');
            $table->string('role');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('otp');
            $table->timestamp('otp_expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registrations');
    }
};
