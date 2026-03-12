<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comic_id')->constrained('comics')->cascadeOnDelete();
            $table->decimal('chapter_number', 8, 2);
            $table->string('title', 255)->nullable();
            $table->string('slug', 255);
            $table->longText('content')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->unsignedInteger('price')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedInteger('downloads')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['comic_id', 'slug'], 'unique_chapter_slug');
            $table->index(['comic_id', 'chapter_number']);
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
