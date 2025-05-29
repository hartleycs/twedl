<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            // ISO-3166-1 alpha-2, 2 chars
            $table->string('code', 2)->unique()->after('iso_code');
        });
    }

    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
