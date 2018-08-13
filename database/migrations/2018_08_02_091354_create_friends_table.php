<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{

    public function up()
    {
        Schema::create('friends', function(Blueprint $table) {
            $table->increments('id');
            $table->char('user_id', 20);
            $table->char('friend_id', 20);
            $table->char('friend_user_id', 20);
            $table->char('nickname', 20);
            $table->char('friend_nickname', 20);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('friends');
    }
}
