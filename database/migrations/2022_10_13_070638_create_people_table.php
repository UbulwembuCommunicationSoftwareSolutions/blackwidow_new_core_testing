<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('maiden_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('weight')->nullable();
            $table->string('length')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('language_spoken')->nullable();
            $table->string('religion')->nullable();
            $table->string('uid')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
