<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $fillable = ['name'];

    public function photos()
    {
        return $this->hasMany('App\Models\Photo','album_id');
    }
}
