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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('province')->default('Jawa Barat');
            $table->integer('price_per_hour');
            $table->decimal('rating', 2, 1)->default(0);
            $table->boolean('is_available')->default(true);
            $table->string('floor_type')->nullable();
            $table->string('changing_room')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('parking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
