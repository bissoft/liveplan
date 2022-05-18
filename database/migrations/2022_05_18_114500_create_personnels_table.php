<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('constant')->nullable();
            $table->string('salary_amount')->nullable();
            $table->boolean('salary_amount_type')->nullable();
            $table->string('salary_amount_start')->nullable();
            $table->string('annual')->nullable();
            $table->string('employee_role')->nullable();
            $table->string('group_constant')->nullable();
            $table->string('group_employee')->nullable();
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
        Schema::dropIfExists('personnels');
    }
}
