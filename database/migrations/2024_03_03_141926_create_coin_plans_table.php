<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coin_plans', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coin_plans');
    }
};
