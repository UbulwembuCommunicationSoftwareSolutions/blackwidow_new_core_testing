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
        Schema::create('user_role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_role_id");
            $table->unsignedBigInteger("user_id");
            $table->index(['user_id', 'user_role_id']);
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
        Schema::dropIfExists('user_role_user');
    }
};
