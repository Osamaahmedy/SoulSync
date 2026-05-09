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
        Schema::create('sparks', function (Blueprint $blade) {
            $blade->id();
            $blade->text('content');
            $blade->string('author')->nullable();
            $blade->string('color')->default('blue');
            $blade->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparks');
    }
};
