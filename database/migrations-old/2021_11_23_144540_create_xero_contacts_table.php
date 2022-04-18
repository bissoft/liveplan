<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeroContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ContactID');
            $table->string('ContactNumber');
            $table->string('AccountNumber')->nullable();
            $table->string('ContactStatus');
            $table->string('Name')->nullable();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('EmailAddress')->nullable();
            $table->string('SkypeUserName')->nullable();
            $table->string('BankAccountDetails')->nullable();
            $table->string('TaxNumber')->nullable();
            $table->string('AccountsReceivableTaxType')->nullable();
            $table->string('AccountsPayableTaxType')->nullable();
            $table->string('IsSupplier')->nullable();
            $table->string('IsCustomer')->nullable();
            $table->string('DefaultCurrency')->nullable();
            $table->string('XeroNetworkKey')->nullable();
            $table->string('SalesDefaultAccountCode')->nullable();
            $table->string('PurchasesDefaultAccountCode')->nullable();
            $table->string('TrackingCategoryName')->nullable();
            $table->string('TrackingCategoryOption')->nullable();
            $table->string('PaymentTerms')->nullable();
            $table->string('UpdatedDateUTC')->nullable();
            $table->string('Website')->nullable();
            $table->string('BrandingTheme')->nullable();
            $table->string('Discount')->nullable();
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
        Schema::dropIfExists('xero_contacts');
    }
}
