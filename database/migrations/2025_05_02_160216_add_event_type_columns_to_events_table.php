<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // allow event_type_id to be null so SQLite can add it
            $table->foreignId('event_type_id')
                  ->nullable()
                  ->after('description')
                  ->constrained('event_types')
                  ->cascadeOnDelete();

            $table->foreignId('event_sub_type_id')
                  ->nullable()
                  ->after('event_type_id')
                  ->constrained('event_sub_types')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropConstrainedForeignId('event_sub_type_id');
            $table->dropConstrainedForeignId('event_type_id');
        });
    }
};
