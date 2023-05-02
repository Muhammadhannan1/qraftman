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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->string('companyName');
            $table->string('image')->nullable();
            $table->integer('organizationNum')->nullable();
            $table->string('website')->nullable();
            $table->integer('companyDescription')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postaddress')->nullable();
            $table->string('streetaddress')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
