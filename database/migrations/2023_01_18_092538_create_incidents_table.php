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
        if(!Schema::hasTable('incidents')){
            Schema::create('incidents', function (Blueprint $table) {
                $table->increments('id');
                $table->longText('description');
                $table->integer('user_id');
                $table->integer('department_id');
                $table->integer('category_id');
                $table->integer('sub_category_id');
                $table->integer('sub_sub_category_id');
                $table->integer('priority_id');
                $table->integer('status_id');
                $table->string('gps_lat');
                $table->string('gps_lng');
                $table->integer('source_id');
                $table->boolean('active')->default(true);
                $table->timestamp('accepted_at');
                $table->timestamp('allocated_at')->nullable();
                $table->timestamp('referred_at');
                $table->timestamp('escalated_at');
                $table->timestamp('resolved_at');
                $table->timestamp('closed_at');
                $table->timestamp('created_at');
                $table->timestamp('updated_at');
                $table->timestamp('due_date')->nullable();
                $table->timestamp('occurred_at')->nullable();
                $table->longText('geoFenceCoords')->nullable();
                $table->string('case_reference')->nullable();
                $table->string('client_reference_number')->nullable();
                $table->string('saps_case_number')->nullable();
                $table->string('saps_station', 50)->nullable();
                $table->integer('investigation_officer_id')->default(0);
                $table->string('unique_id')->default('');
                $table->index(['created_at', 'description']);

            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
};
