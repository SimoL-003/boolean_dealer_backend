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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained();
            $table->integer('price')->nullable();
            $table->integer('km')->nullable();
            $table->string('plate')->unique()->nullable();
            $table->string('chassis')->unique()->nullable();
            $table->year('year')->nullable();
            $table->foreignId('fuel_type_id')->constrained();
            $table->integer('previous_owners')->default(1);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
