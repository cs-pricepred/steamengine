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
        Schema::create('historic_sales', function (Blueprint $table) {
            $table->uuid('id');
            $table->dateTime('time');
            $table->float('price', 8, 3);
            $table->bigInteger('volume');
            $table->foreignUuid('item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historic_sales');
    }
};
