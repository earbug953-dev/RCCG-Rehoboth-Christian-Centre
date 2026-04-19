<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('preacher');
            $table->string('scripture')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('file_type', ['audio', 'video', 'youtube'])->default('audio');
            $table->string('youtube_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->date('sermon_date');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
