<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key_name', 100)->unique();
            $table->longText('value')->nullable();
            $table->enum('type', ['string', 'integer', 'boolean', 'json', 'text'])->default('string');
            $table->string('group_name', 50)->default('general');
            $table->boolean('is_public')->default(false);
            $table->timestamps();

            $table->index('group_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
