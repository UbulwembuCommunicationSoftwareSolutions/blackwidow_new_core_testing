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
                $table->longText('name');
                $table->integer('user_id');
                $table->integer('department_id');
                $table->integer('incident_category_id');
                $table->integer('incident_sub_category_id');
                $table->integer('incident_sub_sub_category_id');
                $table->integer('priority_id');
                $table->integer('incident_status_id');
                $table->string('gps_lat')->nullable();
                $table->string('gps_lng')->nullable();
                $table->integer('source_id')->nullable();
                $table->boolean('active')->default(true);
                $table->timestamp('accepted_at')->nullable();
                $table->timestamp('allocated_at')->nullable();
                $table->timestamp('referred_at')->nullable();
                $table->timestamp('escalated_at')->nullable();
                $table->timestamp('resolved_at')->nullable();
                $table->timestamp('closed_at')->nullable();
                $table->timestamp('created_at');
                $table->timestamp('updated_at');
                $table->timestamp('due_date')->nullable();
                $table->timestamp('occurred_at')->nullable();
                $table->longText('geoFenceCoords')->nullable();
                $table->string('case_reference')->nullable();
                $table->string('client_reference_number')->nullable();
                $table->string('saps_case_number')->nullable();
                $table->string('saps_station', 50)->nullable();
                $table->integer('investigation_officer_id')->nullable()->default(0);
                $table->string('unique_id')->default('');
                $table->index(['created_at']);

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
