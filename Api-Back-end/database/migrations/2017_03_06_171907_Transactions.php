<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Transactions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('transaction_type');
          $table->string('amount');
          $table->string('status');
          $table->date('transaction_date');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transactions');
    }
}
