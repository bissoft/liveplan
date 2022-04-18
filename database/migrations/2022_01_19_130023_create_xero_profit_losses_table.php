<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeroProfitLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xero_profit_losses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ReportID')->nullable();
            $table->string('ReportName')->nullable();
            $table->string('ReportType')->nullable();
            $table->longText('ReportTitles')->nullable();
            $table->string('ReportDate')->nullable();
            $table->string('UpdatedDateUTC')->nullable();
            $table->longText('Rows')->nullable();
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
        Schema::dropIfExists('xero_profit_losses');
    }
}
