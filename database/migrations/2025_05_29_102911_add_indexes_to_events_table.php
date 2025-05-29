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
        Schema::table('events', function (Blueprint $table) {
            // Add indexes to frequently queried columns
            $table->index('user_id');
            $table->index('status');
            $table->index('event_type_id');
            $table->index('event_sub_type_id');
            $table->index('start_datetime');
            $table->index('end_datetime');
            $table->index(['status', 'created_at']);
            $table->index(['user_id', 'status']);
            $table->index('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['event_type_id']);
            $table->dropIndex(['event_sub_type_id']);
            $table->dropIndex(['start_datetime']);
            $table->dropIndex(['end_datetime']);
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['city']);
        });
    }
};
