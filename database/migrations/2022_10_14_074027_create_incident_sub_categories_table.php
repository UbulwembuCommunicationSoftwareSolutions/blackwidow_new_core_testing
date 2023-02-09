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
        Schema::create('incident_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->integer('incident_category_id')->nullable();
            $table->index(['description'])->limit(50);
            $table->index(['incident_category_id']);
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
        Schema::dropIfExists('incident_sub_categories');
    }
};
