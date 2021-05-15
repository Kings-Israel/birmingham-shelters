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
            $table->bigInteger('service_charge');
            $table->bigInteger('area')->nullable();
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->text('address');
            $table->string('state');
            $table->text('zip_code');
            $table->string('city');
            $table->text('description');
            $table->text('features');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('listingimage_id')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}
