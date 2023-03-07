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
        Schema::create('incident_activities', function (Blueprint $table) {
            $table->id();
            $table->longText('note')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('incident_id')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('from_user_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->string('message')->nullable();
            $table->string('description')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('incident_category_id')->nullable();
            $table->integer('incident_sub_category_id')->nullable();
            $table->integer('incident_sub_sub_category_id')->nullable();
            $table->index(['user_id']);
            $table->index(['incident_id']);
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
        Schema::dropIfExists('incident_activities');
    }
};
