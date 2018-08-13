<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PushNotificationsController extends Controller {

    public function sendPush(Request $req)
    {
        define( 'API_ACCESS_KEY', 'AAAA80V_Woc:APA91bHtE27RfIHju9EweNDFLonRVD3Qyg5BZjLmvG2U_znM-MmFrl9qz-svyzvBrWGOSBfTBFd2J3sr8aQEngDBwl0OZdV9IHrSueLgEh_BeMI17UgVytVX1dqkgJCbGeT4HxVnxG4wTW1fy2ayICa2KXD-Yi8M_w' );
        $registrationIds = array($req->input('fcm_token'));
        // prep the bundle
        $msg = array
        (
            'message' 	=> $req->input('content'),
            'title'		=> $req->input('nickname'),
            'subtitle'	=> $req->input('nickname'),
            'tickerText'=> $req->input('nickname'),
            'userId'=> $req->input('user_id'),
            'friendUserId'=> $req->input('to_user_id'),
            'friendId'=> $req->input('friend_id'),
            'vibrate'	=> 1,
            'sound'		=> 1,
            'largeIcon'	=> 'large_icon',
            'smallIcon'	=> 'small_icon'
        );
        $fields = array
        (
            'registration_ids' 	=> $registrationIds,
            'data'			    => $msg
        );
        
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        dd("sent");
    }

}
