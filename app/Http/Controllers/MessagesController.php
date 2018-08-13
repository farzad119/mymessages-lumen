<?php namespace App\Http\Controllers;
use App\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller {

    public function showAllMessages()
    {
        return response()->json(Messages::all());
    }

    public function getMessages(Request $req)
    {
        $friendId=$req->input('friend_id');

        //return $userId.$toUserId;
        $message = Messages::where('friend_id', $friendId)->get();
        
        return response()->json($message);
    }

    public function sendMessage(Request $req)
    {
        $userId=$req->input('user_id');
        $toUserId=$req->input('to_user_id');
        $friendId=$req->input('friend_id');
        $nickname=$req->input('nickname');
        $content=$req->input('content');
    
        //$userId='11';
        //$friendId='3';
        //$toFriendUserId='44';
        //$nickname='Farzad';
        //$content='from android device';
        
        $message = new Messages();
        $message->user_id=$userId;
        $message->to_user_id=$toUserId;
        $message->friend_id=$friendId;
        $message->nickname=$nickname;
        $message->content=$content;
        if($message->save()){
            return response()->json(['status' => 'true','data'=>$message]);
        }else{
            return response()->json(['status' => 'false']);
        }
    }   
}
