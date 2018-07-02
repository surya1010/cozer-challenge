<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
	{
	  $this->middleware('auth');
	}

	public function index()
	{
		return view('chat');
	}

	public function getMessageFromUser($id)
	{
	  return Message::where(function ($query) use ($id) {
            $query->where('sender_id', '=', Auth::user()->id)->where('receiver_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', '=', $id)->where('receiver_id', '=', Auth::user()->id);
        })->get();
	}

	public function sendMessage(Request $request)
	{
	  	$data = Message::create([
	  		'message' 		=> $request->message,
	  		'sender_id' 	=> $request->sender_id,
	  		'receiver_id' 	=> $request->receiver_id,
	  	]);

	  	broadcast(new MessageSent($data));
	  
	  	return ['status' => 'Message Sent!'];
	}


	public function show($id)
	{
		$users = User::find($id);

		return view('chat-private.show', [ 'users' => $users ]);
	}
}
