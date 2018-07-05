<?php

use App\Group;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Chat.{sender_id}.{receiver_id}', function ($user, $sender_id, $receiver_id) {
    return $user->id == $receiver_id;
});

Broadcast::channel('Online', function ($user) {
    return $user;
});


Broadcast::channel('Chat-Group.{group}', function ($user, Group $group) {
    return $group->hasUser($user->id);
});
