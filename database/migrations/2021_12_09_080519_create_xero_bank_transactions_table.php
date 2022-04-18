<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Xero\XeroBankTransaction;

class CreateXeroBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_bank_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            foreach(XeroBankTransaction::$chars as $index){
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
        Schema::dropIfExists('xero_bank_transactions');
    }
}
