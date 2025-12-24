<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudioCommentResource extends JsonResource
{
    public static array $friendIds = [];

    public function toArray(Request $request): array
    {
        $authorId = (int) $this->user_id;

        return [
            'id' => $this->id,
            'text' => $this->text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'author' => [
                'id' => $this->user?->id,
                'username' => $this->user?->username,
                'email' => $this->user?->email,
            ],

            'studio' => [
                'id' => $this->studio?->id,
                'title' => $this->studio?->title,
                'user_id' => $this->studio?->user_id,
            ],

            'is_friend' => in_array($authorId, self::$friendIds, true),
        ];
    }
}