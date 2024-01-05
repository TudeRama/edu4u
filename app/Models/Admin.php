<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    use HasFactory;
    protected $guarded =[''];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hasLike(){
        return $this->hasOne(Like::class)->where('likes.usser_id', Auth::user()->id);
    }

    public function totalLike(){
        return $this->hasMany(Like::class)->count();
    }
}
