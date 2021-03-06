<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Each post is associated to a user
     * 
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}