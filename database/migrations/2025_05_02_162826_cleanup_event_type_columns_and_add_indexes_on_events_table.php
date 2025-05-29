<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop the old string columns
            if (Schema::hasColumn('events', 'event_type')) {
                $table->dropColumn('event_type');
            }
            if (Schema::hasColumn('events', 'event_sub_type')) {
                $table->dropColumn('event_sub_type');
            }

            // Add indexes on the FK columns
            $table->index('event_type_id');
            $table->index('event_sub_type_id');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Remove those indexes
            $table->dropIndex(['event_type_id']);
            $table->dropIndex(['event_sub_type_id']);

            // Restore the old string columns (nullable so we don’t break on existing rows)
            $table->string('event_type')->nullable()->after('description');
            $table->string('event_sub_type')->nullable()->after('event_type');
        });
    }
};
