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
        Schema::create('bus_stops', function (Blueprint $table) {
            $table->string('bus_stop', length:50)->primary();
        });

        Schema::create('routes', function (Blueprint $table) {
            $table->smallInteger('route')->primary();
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('arrival_time', length:5);
            $table->tinyInteger('day_of_the_week');
            $table->tinyInteger('seats_total');
            $table->smallInteger('routes_route');

            $table->foreign('routes_route')->references('route')->on('routes')->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::create('reservations', function (Blueprint $table) {
            $table->date('date_of_reservation');
            $table->tinyInteger('seat_number');
            $table->string('bus_stops_bus_stop', length:50);
            $table->binary('users_id', length:16);
            $table->foreignId('schedule_id')->constrained(
                table: 'schedule', indexName: 'id'
            );

            $table->foreign('bus_stops_bus_stop')->references('bus_stop')->on('bus_stops')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('schedule');
        Schema::dropIfExists('routes');
        Schema::dropIfExists('bus_stops');
    }
};
