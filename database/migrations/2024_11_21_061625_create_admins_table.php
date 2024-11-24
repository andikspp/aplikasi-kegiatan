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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique;
            $table->unsignedBigInteger('pokja_id')->nullable();
            $table->enum('role', ['superadmin', 'admin'])->default('admin');
            $table->string('password');
            $table->timestamps();

            $table->foreign('pokja_id')->references('id')->on('pokjas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['pokja_id']); // Hapus foreign key
        });

        Schema::dropIfExists('admins');
    }
};
