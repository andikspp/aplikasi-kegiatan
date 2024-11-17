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
        Schema::create('quiz_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attempt_id');
            $table->unsignedBigInteger('soal_id');
            $table->text('jawaban');
            $table->boolean('is_correct')->default(false);
            $table->integer('point_earned');
            $table->timestamps();

            $table->foreign('attempt_id')->references('id')->on('quiz_attempt');
            $table->foreign('soal_id')->references('id')->on('soal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_jawaban');
    }
};
