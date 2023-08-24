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
        Schema::create('describes', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('color')->nullable();
            $table->integer('order');
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('describes');
    }
};
