<?php

use App\Xero\XeroRepeatingInvoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeroRepeatingInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_repeating_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            foreach(XeroRepeatingInvoice::$chars as $index){
                $table->string($index)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xero_repeating_invoices');
    }
}
