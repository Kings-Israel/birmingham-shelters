<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{

    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('map_location');
            $table->bigInteger('service_charge');
            $table->text('features');
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_available');
            $table->foreignId('landlord_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}
