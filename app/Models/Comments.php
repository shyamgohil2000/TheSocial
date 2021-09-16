<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'comments_id',
        'comment'
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comments::class,'comments_id');
    }

    public function likes(){
        return $this->belongsToMany(User::class);
    }
}
