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
        Schema::create('fungsi', function (Blueprint $table) {
            $table->id();
            $table->string('function_name');
            $table->string('function_type');
            $table->json('data');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('answer')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fungsi');
    }
};
