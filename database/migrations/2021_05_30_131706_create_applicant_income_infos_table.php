<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantIncomeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_income_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_metadata_id');
            $table->text('source_of_income');
            $table->string('dwp_office')->nullable();
            $table->text('other_debt')->nullable();
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
        Schema::dropIfExists('applicant_income_infos');
    }
}
