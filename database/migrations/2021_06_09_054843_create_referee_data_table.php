<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referee_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('referral_type');
            $table->string('referrer_name');
            $table->string('referrer_phone_number');
            $table->string('referrer_email');
            $table->text('referral_reason');
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone_number');
            $table->date('applicant_date_of_birth');
            $table->string('applicant_ni_number');
            $table->text('applicant_current_address');
            $table->string('applicant_gender');
            $table->string('applicant_sexual_orientation');
            $table->string('applicant_ethnicity');
            $table->string('applicant_kin_name');
            $table->string('applicant_kin_relationship');
            $table->string('applicant_kin_phone_number');
            $table->string('applicant_kin_email');
            $table->string('applicant_image')->nullable();
            $table->boolean('consent')->default(false);
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
        Schema::dropIfExists('referee_data');
    }
}
