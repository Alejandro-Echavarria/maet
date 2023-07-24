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
        Schema::create('jobs', function (Blueprint $table) {

            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('client_id')->constrained()->nullable();
            $table->string('title');
            $table->string('logo_url')->nullable();
            $table->string('color');
            $table->string('project_name');
            $table->string('languages');
            $table->text('preview');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
