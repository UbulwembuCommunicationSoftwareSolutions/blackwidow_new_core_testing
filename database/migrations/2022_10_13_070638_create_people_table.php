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
            $table->string('id_number')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('home_address')->nullable();
            $table->string('work_address')->nullable();
            $table->integer('ethnic_group_id')->nullable();
            $table->integer('marital_status_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('nationality_id')->nullable();
            $table->string('language_spoken')->nullable();
            $table->string('religion_id')->nullable();
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
