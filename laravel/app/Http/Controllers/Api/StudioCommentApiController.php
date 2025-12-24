<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudioCommentResource;
use App\Models\Studio;
use App\Models\StudioComment;
use Illuminate\Http\Request;

class StudioCommentApiController extends Controller
{
    public function index(Request $request, Studio $studio)
    {
        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioCommentResource::$friendIds = $friendIds;

        $comments = StudioComment::query()
            ->with(['user', 'studio'])
            ->where('studio_id', $studio->id)
            ->latest()
            ->get();

        return StudioCommentResource::collection($comments);
    }

    public function store(Request $request, Studio $studio)
    {
        $data = $request->validate([
            'text' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $comment = StudioComment::query()->create([
            'studio_id' => $studio->id,
            'user_id' => $request->user()->id,
            'text' => $data['text'],
        ]);

        $comment->load(['user', 'studio']);

        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioCommentResource::$friendIds = $friendIds;

        return (new StudioCommentResource($comment))->response()->setStatusCode(201);
    }

    public function update(Request $request, StudioComment $comment)
    {
        abort_unless(
            $request->user()->is_admin || $comment->user_id === $request->user()->id,
            403
        );

        $data = $request->validate([
            'text' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $comment->update($data);
        $comment->load(['user', 'studio']);

        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioCommentResource::$friendIds = $friendIds;

        return new StudioCommentResource($comment);
    }
}