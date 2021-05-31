<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantAddressInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_address_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_metadata_id');
            $table->string('address');
            $table->date('moved_in');
            $table->date('moved_out');
            $table->string('tenure');
            $table->string('landlord_details');
            $table->text('reason_for_leaving');
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
        Schema::dropIfExists('applicant_address_infos');
    }
}
