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
            $table->bigInteger('total');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoicable_id');
            $table->string('invoicable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
}
