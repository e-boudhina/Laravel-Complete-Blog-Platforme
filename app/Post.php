<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $guarded = [
        'id'
    ];

    /**
     * Delete post image from storage
     */
    public function deleteImage()
    {
Storage::delete($this->image);
    }
    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * check if post had tags
     * @param $tagid
     * @return bool
     */
    public function hasTag($tagid)
    {
        return in_array($tagid, $this->tags->pluck('id')->toArray());

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search)
        {
            return $query;
        }
        return $query->where('title','like',"%{$search}%");
    }
}
