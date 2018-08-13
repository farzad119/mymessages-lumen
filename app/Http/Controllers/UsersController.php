<?php namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    public function login(Request $req)
    {
        if(User::where('username', $req->input('username'))->exists()){
            $user = User::where('username', $req->input('username'))->first();
            if (Hash::check($req->input('password'), $user->password)){
                return response()->json(['status' => 'true','user'=>$user]);
            }else{
                return response()->json(['status' => 'false']);
            }
        }
    }
    
    public function signup(Request $req)
    {
        $nickname = $req->input('nickname');
        $username = $req->input('username');
        $password = Hash::make($req->input('password'));
        $email = $req->input('email');
        
        if(User::where('username', $username)->exists()){
            return response()->json(['status' => 'false']);
        }else{
            $user = new User();
            $user->user_id=$this->quickRandom();
            $user->nickname=$nickname;
            $user->username=$username;
            $user->password=$password;
            $user->email=$email;
            if($user->save()){
                return response()->json(['status' => 'true','user'=>$user]);
            }
        }
    }

    public function updateFcmToken(Request $req)
    {
        $userId=$req->input('user_id');
        $token=$req->input('fcm_token');
        if (User::where('user_id', $userId)->update(['fcm_token'=>$token])){
            return 'true';
        }else{
            return 'false';
        }
    }
    
    public function quickRandom($length = 8){
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
