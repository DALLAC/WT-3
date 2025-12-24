<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudioResource;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioApiController extends Controller
{
    public function index(Request $request)
    {
        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioResource::$friendIds = $friendIds;

        $studios = Studio::query()
            ->with('user')
            ->latest()
            ->get();

        return StudioResource::collection($studios);
    }

    public function show(Request $request, Studio $studio)
    {
        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioResource::$friendIds = $friendIds;

        $studio->load('user');

        return new StudioResource($studio);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:2048'],
            'location' => ['nullable', 'string', 'max:255'],
            'founded_at' => ['nullable', 'date'],
        ]);

        $studio = new Studio($data);
        $studio->user_id = $request->user()->id;
        $studio->save();

        $studio->load('user');

        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioResource::$friendIds = $friendIds;

        return (new StudioResource($studio))->response()->setStatusCode(201);
    }

    public function update(Request $request, Studio $studio)
    {
        $this->authorize('update-studio', $studio);

        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'short_description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'image' => ['sometimes', 'nullable', 'string', 'max:2048'],
            'location' => ['sometimes', 'nullable', 'string', 'max:255'],
            'founded_at' => ['sometimes', 'nullable', 'date'],
        ]);

        $studio->fill($data)->save();
        $studio->load('user');

        $friendIds = $request->user()->friends()->pluck('users.id')->all();
        StudioResource::$friendIds = $friendIds;

        return new StudioResource($studio);
    }
}