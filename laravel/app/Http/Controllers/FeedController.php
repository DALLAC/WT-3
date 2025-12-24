<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $friendIds = $request->user()
            ->friends()
            ->pluck('users.id')
            ->all();

        $studios = Studio::query()
            ->with('user')
            ->whereIn('user_id', $friendIds)
            ->latest()
            ->get();

        return view('feed.index', compact('studios'));
    }
}