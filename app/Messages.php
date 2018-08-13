<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model {

    protected $fillable = ['user_id','to_user_id','friend_id','nickname','content',];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
