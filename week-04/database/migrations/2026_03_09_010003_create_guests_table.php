<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('qr_token')->unique()->nullable();
            $table->boolean('checkin_status')->default(false);
            $table->boolean('souvenir_status')->default(false);
            $table->dateTime('checkin_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
