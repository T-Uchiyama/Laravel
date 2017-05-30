<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'category_id'];

    public function attachments()
    {
        return $this->hasMany('App\Attachment', 'foreign_key');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\Category');
    }
    
}
