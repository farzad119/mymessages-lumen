<?php namespace App\Http\Controllers;
use App\Friends;
use App\User;
use Illuminate\Http\Request;

class FriendsController extends Controller {

    public function allFriends(Request $req)
    {
        $userId=$req->input('user_id');

        //return $userId.$toUserId;
        $friends = Friends::where('user_id', $userId)->orWhere('friend_user_id', $userId)->orderBy('id', 'desc')->get();

        $array = [];
        foreach($friends as $f){
            $friend = new Friends();
            if($userId==$f->user_id){
                $user = User::where('user_id', $f->friend_user_id)->first();
                $friend->user_id         = $f->user_id;
                $friend->nickname        = $f->nickname;
                $friend->friend_user_id  = $f->friend_user_id;
                $friend->friend_nickname = $f->friend_nickname;
                $friend->friend_id       = $f->friend_id;
                $friend->fcm_token       = $user->fcm_token;
            }else{
                $user = User::where('user_id', $f->user_id)->first();
                $friend->user_id         = $f->friend_user_id;
                $friend->nickname        = $f->friend_nickname;
                $friend->friend_user_id  = $f->user_id;
                $friend->friend_nickname = $f->nickname;
                $friend->friend_id       = $f->friend_id;
                $friend->fcm_token       = $user->fcm_token;
            }
            $array = array_prepend($array,$friend);
        }

        return response()->json($array);
    }

    public function addFriend(Request $req)
    {
        $userId=$req->input('user_id');
        $friendUserId=$req->input('friend_user_id');
        $nickname=$req->input('nickname');
        $friendNickname=$req->input('friend_nickname');

        if(Friends::where('user_id', $userId)->where('friend_user_id', $friendUserId)->orWhere('user_id', $friendUserId)->where('friend_user_id', $userId)->exists()){
            return "false";
        }else{
            $friend = new Friends();
            $friend->user_id=$userId;
            $friend->friend_user_id=$friendUserId;
            $friend->nickname=$nickname;
            $friend->friend_nickname=$friendNickname;            
            $friend->friend_id = $this->quickRandom();            
            $friend->save();
            return "true";
        }
    }

    public function deleteFriend(Request $req)
    {
        $userId=$req->input('user_id');
        $friendId=$req->input('friend_id');
        
        //Friends::where('user_id', $userId)->where('friend_user_id', $friendUserId)->orWhere('user_id', $friendUserId)->where('friend_user_id', $userId)->delete();

        if(Friends::where('user_id', $userId)->orWhere('friend_user_id', $userId)->where('friend_id', $friendId)->delete()){
            return "true";
        }else{
            return "false";
        }
    }

    public function quickRandom($length = 8){
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    public function searchFriend(Request $req){
        $username = $req->input('username');
        $user = User::where('username', $username)->first();
        return $user;
    }
}
