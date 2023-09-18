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
        Schema::create('resources', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->foreignId('language_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('description', 1000)->nullable();
            $table->foreignId('media_id')->constrained()->cascadeOnUpdate();
            $table->string('file');
            $table->string('thumbnail')->nullable();
            $table->enum('visibility', ['public', 'private'])->default('private');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
