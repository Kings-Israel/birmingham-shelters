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
            $table->text('local_authority_area');
            $table->text('description');
            $table->integer('living_rooms');
            $table->integer('bedsitting_rooms');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('toilets');
            $table->integer('kitchen');
            $table->text('other_rooms')->nullable();
            $table->text('features')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_available')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->string('contact_name');
            $table->string('contact_email');
            $table->bigInteger('contact_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}
