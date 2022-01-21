<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'parent_id', 'comment', 'user_id','repliable_id','repliable_type'
    ];

    //relation with user 
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    //relation with replies 
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at','desc');
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class,'repliable')->where('parent_id','=',0);
    }

}
