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
        Schema::create('department_institution', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("institution_id");
            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->unsignedBigInteger("department_id");
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('department_institution');
    }
};
