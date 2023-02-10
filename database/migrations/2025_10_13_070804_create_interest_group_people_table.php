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
        Schema::create('interest_group_people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("person_id");
            $table->unsignedBigInteger("interest_group_id");
            $table->index(['person_id', 'interest_group_id']);
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
        Schema::dropIfExists('interest_group_people');
    }
};
