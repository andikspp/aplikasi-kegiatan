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
        Schema::create('opsi_jawaban', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('soal_id')->unsigned();
            $table->text('jawaban');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opsi_jawaban');
    }
};
