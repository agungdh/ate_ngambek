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
        Schema::create('ngambek_selesais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ngambek_id')->unique()->constrained()->cascadeOnDelete()->restrictOnUpdate();
            $table->timestampTz('kapan');
            $table->string('gimana');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngambek_selesais');
    }
};
