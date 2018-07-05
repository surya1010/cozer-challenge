<?php

namespace App\Http\Controllers;

use App\Events\NewMessageGroup;
use App\MessageGroups;
use Illuminate\Http\Request;

class ChatGroupController extends Controller
{
    public function __construct()
	{
	  $this->middleware('auth');
	}


	public function getMessage($id)
	{
	  return MessageGroups::with('user')->where( 'group_id', $id )->get();
	}


	public function sendMessage(Request $request)
	{
	  	$data = MessageGroups::create([
	  		'message' 	=> $request->message,
	  		'group_id' 	=> $request->group_id,
	  		'user_id' 	=> $request->user['id'],
	  	]);

	  	broadcast(new NewMessageGroup($data));
	  
	  	return ['status' => 'Message Sent!'];
	}
}
