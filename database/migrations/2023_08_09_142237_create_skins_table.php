<?php

use App\Models\Weapon;
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
        Schema::create('skins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Weapon::class);
            $table->string('name');
            $table->enum('wear', ['Factory New', 'Minimal Wear']);
            $table->enum('rarity', ['gold', 'red', 'purple']);
            $table->boolean('stattrak');
            $table->json('sale_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skins');
    }
};
