<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'caption',
        'description',
        'image'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comments::class,'post_id')->whereNull('comments_id');
    }
    public function likes(){
        return $this->belongsToMany(User::class);
    }
}
