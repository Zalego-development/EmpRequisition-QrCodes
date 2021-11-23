<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesrequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeerequisitions', function (Blueprint $table) {
            $table->id();
            $table->string('jobtittle');
            $table->string('jobdescription');
            $table->integer('positions');
            $table->string('employementtype');
            $table->string('salary');
            $table->string('positiontype');
            $table->string('intenting');
            $table->string('pwd');
            $table->string('jobcategory');
            $table->string('location');
            $table->date('startdate');
            $table->string('posskills');
            $table->string('posrequirements');
            $table->integer('interviews');
            $table->integer('manager');
            $table->string('status');
            $table->integer('stages');
            $table->integer('stage1');
            $table->integer('stage2');
            $table->string('responsibilities');
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
        Schema::dropIfExists('employeerequisitions');
    }
}
