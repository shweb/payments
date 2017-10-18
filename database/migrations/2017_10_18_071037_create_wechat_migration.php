<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->integer('booking');
            $table->float('amount')->nullable();
            $table->string('status');
            $table->string('transaction_id')->unique()->nullable();
            $table->string('bank_type')->nullable();
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
        Schema::dropIfExists('wechat');
    }
}
