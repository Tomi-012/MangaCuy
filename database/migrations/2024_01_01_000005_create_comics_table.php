<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('alternative_title', 255)->nullable();
            $table->longText('synopsis')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->foreignId('type_id')->constrained('types')->restrictOnDelete();
            $table->foreignId('status_id')->constrained('statuses')->restrictOnDelete();
            $table->string('author', 255)->nullable();
            $table->string('artist', 255)->nullable();
            $table->year('released_year')->nullable();
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->unsignedBigInteger('total_views')->default(0);
            $table->unsignedInteger('total_bookmarks')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_adult')->default(false);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('slug');
            $table->index(['type_id', 'status_id']);
            $table->index('is_featured');
            $table->index('is_hot');
            $table->index('published_at');
            $table->fullText(['title', 'alternative_title', 'synopsis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
