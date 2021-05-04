<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteerMetadataTable extends Migration
{

    public function up(): void
    {
        Schema::create('volunteer_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('approved_at')->nullable();
            $table->string('paypal_email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_metadata');
    }
}
