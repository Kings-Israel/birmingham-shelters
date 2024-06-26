<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantHealthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_health_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referee_data_id');
            $table->string('professional_officer')->nullable();
            $table->string('gp_name')->nullable();
            $table->string('gp_address')->nullable();
            $table->string('detained_for_mental_health');
            $table->text('mental_health')->nullable();
            $table->text('physical_health')->nullable();
            $table->text('present_medication')->nullable();
            $table->text('current_cpa')->nullable();
            $table->text('other_relevant_information')->nullable();
            $table->string('has_criminal_offence')->nullable();
            $table->text('criminal_offence_details')->nullable();
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
        Schema::dropIfExists('applicant_health_infos');
    }
}
