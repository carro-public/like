<?php

namespace CarroPublic\Like;

class Like
{
    protected $fillable = [
        'likeable_type',
        'likeable_id',
        'user_id',
    ];

    /**
     * Likeable
     *
     * @return mixed
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Liker
     *
     * @return mixed
     */
    public function liker()
    {
        return $this->belongsTo($this->getAuthModelName(), 'user_id');
    }

    /**
     * Get auth model name
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getAuthModelName()
    {
        if (config('discussion.user_model')) {
            return config('discussion.user_model');
        }

        if (!is_null(config('auth.providers.users.model'))) {
            return config('auth.providers.users.model');
        }

        throw new Exception('Could not determine the discusser model name.');
    }
}
