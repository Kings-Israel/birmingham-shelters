<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{

    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_type');
            $table->text('description')->nullable();
            $table->bigInteger('total'); // saved in cents
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoiceable_id');
            $table->string('invoiceable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
}
