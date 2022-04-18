<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeroInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Type')->nullable();
            $table->string('Contact')->nullable();
            $table->string('LineItems')->nullable();
            $table->string('Date')->nullable();
            $table->text('DueDate')->nullable();
            $table->string('LineAmountTypes')->nullable();
            $table->string('InvoiceNumber')->nullable();
            $table->string('CurrencyCode')->nullable();
            $table->string('Status')->nullable();
            $table->string('InvoiceID')->nullable();
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
        Schema::dropIfExists('xero_invoices');
    }
}
