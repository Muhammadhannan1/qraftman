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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->unsignedBigInteger('postTypeId');
            $table->foreign('postTypeId')->references('id')->on('posttypes');
            $table->string('projectTitle')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('latitude')->nullable();
            $table->integer('longitude')->nullable();
            $table->dateTime('startDateTime')->nullable();
            $table->dateTime('endDateTime')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->integer('numberOfWorkers')->nullable();
            $table->unsignedBigInteger('serviceId');
            $table->foreign('serviceId')->references('id')->on('services');
            $table->unsignedBigInteger('requiredId');
            $table->foreign('requiredId')->references('id')->on('requireds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
