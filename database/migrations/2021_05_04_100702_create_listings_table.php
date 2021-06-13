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
            $table->text('address');
            $table->text('postcode');
            $table->text('description');
            $table->integer('living_rooms');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('toilets');
            $table->integer('kitchen');
            $table->json('other_rooms')->nullable();
            $table->json('features')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_available')->default(true);
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_number')->nullable();
            $table->json('images')->nullable();
            $table->json('supported_groups')->nullable();
            $table->text('support_description')->nullable();
            $table->integer('support_hours')->nullable();
            $table->json('proofs')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}
