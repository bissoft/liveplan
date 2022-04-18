<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeroAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Code')->nullable();
            $table->string('Name')->nullable();
            $table->string('BankAccountNumber')->nullable();
            $table->string('Status')->nullable();
            $table->text('Description')->nullable();
            $table->string('BankAccountType')->nullable();
            $table->string('CurrencyCode')->nullable();
            $table->string('TaxType')->nullable();
            $table->string('AccountID')->nullable();
            $table->string('Class')->nullable();
            $table->string('SystemAccount')->nullable();
            $table->string('ReportingCode')->nullable();
            $table->string('ReportingCodeName')->nullable();
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
        Schema::dropIfExists('xero_accounts');
    }
}
