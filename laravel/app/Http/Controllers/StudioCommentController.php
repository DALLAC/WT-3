<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\StudioComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudioCommentController extends Controller
{
    public function store(Request $request, Studio $studio): RedirectResponse
    {
        $request->validate([
            'text' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        StudioComment::create([
            'studio_id' => $studio->id,
            'user_id' => $request->user()->id,
            'text' => $request->input('text'),
        ]);

        return back();
    }
}