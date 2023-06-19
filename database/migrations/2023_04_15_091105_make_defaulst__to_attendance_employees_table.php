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
        Schema::table('attendance_employees', function (Blueprint $table) {
            $table->time('clock_in')->nullable()->change();
            $table->time('clock_out')->nullable()->change();
            $table->time('late')->nullable()->change();
            $table->time('early_leaving')->nullable()->change();
            $table->time('overtime')->nullable()->change();
            $table->time('total_rest')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
   
};
