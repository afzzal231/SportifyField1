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
        Schema::create('venue_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('venue_name');
            $table->string('sport_type');
            $table->text('description')->nullable();
            $table->integer('price_per_hour')->nullable();
            $table->string('owner_name');
            $table->string('owner_email');
            $table->string('owner_phone');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_registrations');
    }
};
