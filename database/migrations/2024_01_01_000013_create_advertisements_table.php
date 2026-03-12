<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('code');
            $table->enum('position', ['header', 'sidebar_top', 'sidebar_bottom', 'content_top', 'content_bottom', 'popup', 'interstitial']);
            $table->boolean('is_active')->default(true);
            $table->enum('display_on', ['all', 'home', 'comic', 'chapter', 'search'])->default('all');
            $table->integer('priority')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('impressions')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamps();

            $table->index(['position', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
