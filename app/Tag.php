<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    protected $table = 'tags';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timestamps = true;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
