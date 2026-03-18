<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('breed')->default('Ahalteke Bedewi');
            $table->integer('age')->nullable();
            $table->integer('height')->nullable()->comment('cm');
            $table->string('color')->nullable();
            $table->string('gender')->nullable();
            $table->text('description')->nullable();
            $table->string('video_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
