<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    

          Schema::create('history_log', function (Blueprint $table) {
            $table->integer('log_id')->Default('0');
            $table->integer('id')->Default('0');
            $table->string('email_address');
            $table->string('action')->nullable();
            $table->timestamp('actions')->nullable();
            $table->string('ip')->nullable();
            $table->string('host')->nullbale();
            $table->string('login_time')->nullable();
            $table->string('logout_time')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
