<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id');
            $table->string('gas_certificate');
            $table->date('gas_certificate_expiry_date');
            $table->string('electrical_certificate');
            $table->date('electrical_certificate_expiry_date');
            $table->string('detectors_certificate');
            $table->date('detectors_certificate_expiry_date');
            $table->string('emergency_lighting_certificate');
            $table->date('emergency_lighting_certificate_expiry_date');
            $table->string('fire_risk_certificate');
            $table->date('fire_risk_certificate_expiry_date');
            $table->string('pat_certificate');
            $table->date('pat_certificate_expiry_date');
            $table->string('insurance_certificate');
            $table->date('insurance_certificate_expiry_date');
            $table->string('ownership_certificate');
            $table->date('ownership_certificate_expiry_date');
            $table->text('proofs')->nullable();
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
        Schema::dropIfExists('listing_documents');
    }
}
