<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    public function profileImage(){
        $imagePath = ($this->image)?'/storage/'.$this->image:'/defaultImage/userDefault.svg';
        return $imagePath;
    }
    protected $fillable = [
        'title',
        'description',
        'url',
        'image'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
