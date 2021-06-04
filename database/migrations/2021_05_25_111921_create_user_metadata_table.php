<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('referral_type');
            $table->string('referrer_name');
            $table->bigInteger('referrer_phone_number');
            $table->string('referrer_email');
            $table->text('referral_reason');
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone_number');
            $table->date('applicant_date_of_birth');
            $table->bigInteger('applicant_ni_number');
            $table->text('applicant_current_address');
            $table->string('applicant_gender');
            $table->string('applicant_sexual_orientation');
            $table->string('applicant_ethnicity');
            $table->string('applicant_kin_name');
            $table->string('applicant_kin_relationship');
            $table->bigInteger('applicant_kin_phone_number');
            $table->string('applicant_kin_email');
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
        Schema::dropIfExists('user_metadata');
    }
}
