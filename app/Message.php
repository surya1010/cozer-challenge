<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

	protected $fillable = ['message', 'sender_id', 'receiver_id'];

    public function user_sender()
	{
	  return $this->belongsTo(User::class, 'sender_id', 'id');
	}

	public function user_receiver()
	{
	  return $this->belongsTo(User::class, 'receiver_id', 'id');
	}
}
