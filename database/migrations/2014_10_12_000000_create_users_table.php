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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('cellphone')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('Active');
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->integer('language_id')->nullable();
            $table->uuid('uid')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index(['created_at', 'first_name','surname']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
