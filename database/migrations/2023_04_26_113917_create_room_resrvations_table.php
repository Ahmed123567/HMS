<?php

use Illuminate\Console\View\Components\Task;
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
        Schema::create('room_resrvations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("room_id");
            $table->unsignedInteger("patient_id");
            $table->date("from");
            $table->date("to");
            $table->tinyInteger("is_confirmed")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_resrvations');
    }
};
