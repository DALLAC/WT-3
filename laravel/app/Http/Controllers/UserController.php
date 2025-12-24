<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->get();

        $friendIds = auth()->check()
            ? auth()->user()->friends()->pluck('users.id')->all()
            : [];

        return view('users.index', compact('users', 'friendIds'));
    }
}