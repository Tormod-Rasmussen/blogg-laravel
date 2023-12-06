<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Thread extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id');
    }

}
