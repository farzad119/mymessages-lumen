<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('messages', 'MessagesController@getMessages');
    $router->post('message', 'MessagesController@sendMessage');
    
    $router->post('login', 'UsersController@login');
    $router->post('signup', 'UsersController@signup');
    $router->post('updatefcmtoken', 'UsersController@updateFcmToken');

    $router->post('dialogs', 'FriendsController@allFriends');
    $router->post('allfriends', 'FriendsController@allFriends');
    $router->post('all-friends', 'FriendsController@allFriends');
    
    $router->post('delete-friend', 'FriendsController@deleteFriend');
    $router->post('add-friend', 'FriendsController@addFriend');
    $router->post('search-friend', 'FriendsController@searchFriend');

    $router->post('push-notification', 'PushNotificationsController@sendPush');
});