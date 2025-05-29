<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('states'); // in case it already exists

        Schema::create('states', function (Blueprint $table) {
            $table->id();

            // Two-letter country code, must match countries.iso_code
            $table->string('country_code', 2);

            // Human-readable state/province name
            $table->string('name');

            // Optional lat/lng center point
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();

            // Index & FK for lookups / integrity
            $table->index('country_code');
            $table->foreign('country_code')
                  ->references('iso_code')
                  ->on('countries')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropForeign(['country_code']);
        });
        Schema::dropIfExists('states');
    }
};
