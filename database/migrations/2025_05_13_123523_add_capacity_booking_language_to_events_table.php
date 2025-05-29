<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('max_attendees')->nullable();
            $table->string('booking_url')->nullable();
            $table->string('language')->nullable();
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['max_attendees', 'booking_url', 'language']);
        });
    }
};
