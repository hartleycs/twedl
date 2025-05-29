<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('event_sub_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_type_id')
                  ->constrained('event_types')
                  ->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['event_type_id','name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_sub_types');
    }
};
