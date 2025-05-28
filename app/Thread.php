<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title', 'body', 'slug', 'channel_id'];

    //Scopes
    public function scopeThreadsByChannels(Builder $query, string $slug = null)
    {
        $query = $query
            ->with('user', 'channel')
            ->withCount('replies')
            ->orderBy('created_at', 'DESC');

        if (! is_null($slug)) {
            $query->whereHas('channel', function ($query) use ($slug) {
                return $query->whereSlug($slug);
            });
        }

        return $query->paginate(15);
    }

    //Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->orderBy('created_at', 'DESC');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
