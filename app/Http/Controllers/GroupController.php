<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Group;
use App\Http\Requests\Grup\createRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        
    	return view('group.index', ['groups' => $user->groups]);
    }

    public function create()
    {
    	return view('group.create', [ 'users' => User::where('id', '!=', Auth::user()->id)->get() ]);
    }

    public function store(createRequest $request)
    {
    	$group = Group::create([ 'name' => $request->name ]);

    	$users_other = collect( $request->users );

    	$users_other->push( Auth::user()->id );

    	$group->users()->attach($users_other);

        //broadcast(new GroupCreated($group));

        return redirect()->route('groups.show', ['id' => $group->id]);
 
    }


    public function show($id)
    {
        
        return view('group.chat_group', [ 'group' => Group::find($id), 'users'=> User::find(Auth::user()->id ) ]);
    }
}
