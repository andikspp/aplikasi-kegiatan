<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Prompts\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('quizz', function (Blueprint $table) {
            $table->unsignedBigInteger('kegiatan_id')->after('id');

            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizz', function (Blueprint $table) {
            $table->dropForeign('kegiatan_id');
            $table->dropColumn('kegiatan_id');
        });
    }
};
