<?php

namespace CarroPublic\Like\Traits;

trait HasLikes
{
    /**
     * Likes
     *
     * @return mixed
     */
    public function likes()
    {
        return $this->morphMany(config('like.like_class'), 'likeable');
    }

    /**
     * Like
     */
    public function like()
    {
        $this->likes()->firstOrCreate([
            'likeable_type' => get_class(),
            'likeable_id' => $this->id,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Unlike
     */
    public function unlike()
    {
        $this->likes()->where([
            'likeable_type' => get_class(),
            'likeable_id' => $this->id,
            'user_id' => auth()->user()->id
        ])->delete();
    }
}
