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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Creator
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('event_type')->nullable(); // e.g. concert, seminar
        $table->string('event_sub_type')->nullable(); // e.g. rock concert, business seminar
        $table->string('location_address')->nullable();
        $table->string('location_coords')->nullable(); // For map integration later
        $table->string('website_url')->nullable();
        $table->dateTime('start_datetime');
        $table->dateTime('end_datetime');
        $table->dateTime('appearance_datetime')->nullable();
        $table->dateTime('takedown_datetime')->nullable();
        $table->boolean('is_free')->default(false);
        $table->decimal('price', 8, 2)->nullable();
        $table->enum('visibility', ['private', 'public'])->default('public');
        $table->json('invitees')->nullable(); // Only for private events
        $table->boolean('age_restricted')->default(false);
        $table->text('accessibility_info')->nullable();
        $table->string('tags')->nullable();
        $table->string('venue_capacity')->nullable();
        $table->text('covid_measures')->nullable();
        $table->enum('status', ['N', 'V', 'L', 'LE', 'VF'])->default('N'); // New, Vetted, Live, etc.
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
