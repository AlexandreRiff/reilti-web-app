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
        Schema::create('resources_disciplines', function (Blueprint $table) {
            $table->primary(['resource_id', 'discipline_id']);
            $table->foreignUlid('resource_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('discipline_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_disciplines');
    }
};
