<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique(); // e.g., "CL1", "Lab 3"
            $table->string('status')->default('Available'); // 'Occupied' or 'Available'
            $table->string('faculty_name')->nullable();
            $table->string('section_name')->nullable(); // e.g., "BSIT3-C"
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laboratories');
    }
};