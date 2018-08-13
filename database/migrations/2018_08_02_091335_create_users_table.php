<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->char('user_id', 20);
            $table->char('username', 20);
            $table->char('password',100);
            $table->char('nickname',20);
            $table->char('profile_image',50);
            $table->text('fcm_token');
            $table->char('email',30);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
