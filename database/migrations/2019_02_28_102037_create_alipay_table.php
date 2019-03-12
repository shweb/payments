<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlipayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alipay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->integer('booking');
            $table->dateTime('timestamp');
            $table->float('total_amount');
            $table->string('out_trade_no');
            $table->string('trade_no');
            $table->string('seller_id');
            $table->string('status');
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
        Schema::dropIfExists('alipay');
    }
}
//out_trade_no=201922812358866
//total_amount=0.01
//sign=LXUuMHvvZiFRsYGgJatiXU3bMzG3%2Bgx3vLhWX5fnggjc0bXy8VNGkdN97lLmsIVSdXiVDyx111SPTFs2w7dRH6srNw094Rlh3MKYvzILgigSEg7Z2ceU6leo09NLINBeyCdhtWEIUOtnfi5RZSwE2KbEfQVB1ee7BXDZrDHsakE76A2c2SheoZ0hPlSm5GqMTffr%2F%2Fdht2LFisgYjWeygk9pXJLcd0uUgU771ZC5ne%2FjseAKXJJFlgobnKDUqI%2F%2BJ1hcCfTa0279A0icAvTDo9Zhs0Gr7EgnMwmYqeSFRbP1JrycNAjpmO4yqCocG%2FIFKDYNv0%2F2vM3PukC0yCm4RA%3D%3D
//trade_no=2019022822001485331019086607
//seller_id=2088121189992507