<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user): RedirectResponse
    {
        $me = $request->user();

        abort_if($me->id === $user->id, 422, 'Нельзя добавить себя в друзья');

        $me->friends()->syncWithoutDetaching([$user->id]);
        $user->friends()->syncWithoutDetaching([$me->id]);

        return back();
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $me = $request->user();

        abort_if($me->id === $user->id, 422, 'Нельзя удалить себя из друзей');

        $me->friends()->detach($user->id);
        $user->friends()->detach($me->id);

        return back();
    }
}