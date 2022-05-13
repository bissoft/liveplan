<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->boolean('cost')->default(0);
            $table->boolean('constant')->default(0);
            $table->string('cost_amount')->nullable();
            $table->string('cost_amount_type')->nullable();
            $table->string('cost_amount_start')->nullable();
            $table->bigInteger('revenue_id')->nullable();
            $table->boolean('revenue_constant')->default(0);
            $table->string('revenue_cost_amount')->nullable();
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
        Schema::dropIfExists('direct_costs');
    }
}
