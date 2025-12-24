<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudioResource extends JsonResource
{
    public static array $friendIds = [];

    public function toArray(Request $request): array
    {
        $ownerId = (int) $this->user_id;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'image' => $this->image,
            'location' => $this->location,
            'founded_at' => $this->founded_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'owner' => [
                'id' => $this->user?->id,
                'username' => $this->user?->username,
                'email' => $this->user?->email,
            ],

            'is_friend' => in_array($ownerId, self::$friendIds, true),
        ];
    }
}