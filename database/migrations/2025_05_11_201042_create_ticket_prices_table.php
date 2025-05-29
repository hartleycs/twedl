<?php

// database/migrations/xxxx_xx_xx_create_ticket_prices_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ticket_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->decimal('price', 8, 2)->nullable(); // Nullable for "Free"
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ticket_prices');
    }
};
