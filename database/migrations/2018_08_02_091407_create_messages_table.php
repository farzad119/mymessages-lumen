<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->char('user_id', 20);
            $table->char('to_user_id', 20);
            $table->char('friend_id', 20);
            $table->char('nickname', 20);
            $table->text('content');
            $table->timestamp('sent_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
