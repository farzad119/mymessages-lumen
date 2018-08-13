<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model {

    protected $fillable = ['id','user_id','friend_id','friend_user_id','nickname','friend_nickname'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
