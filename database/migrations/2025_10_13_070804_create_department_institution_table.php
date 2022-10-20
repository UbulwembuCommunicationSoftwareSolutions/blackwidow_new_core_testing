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
            $table->unsignedBigInteger("department_id");
            $table->index(['department_id', 'institution_id']);
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
