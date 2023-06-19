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
        Schema::table('appointment_resrvations', function (Blueprint $table) {
            $table->tinyInteger("is_confirmed")->default(0);
            $table->tinyInteger("is_closed")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_resrvations', function (Blueprint $table) {
            $table->dropColumn("is_confirmed");
            $table->dropColumn("is_closed");
        });
    }
};
