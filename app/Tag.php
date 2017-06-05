<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tagName'];

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
