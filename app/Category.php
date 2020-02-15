<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    // Table Name
    protected $table = 'categories';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timestamps = true;
    protected $guarded = [
        'id'
    ];

    public function posts()
    {
        return   $this->hasMany(Post::class);
    }
}
