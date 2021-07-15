<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'img_path', 'tag', 'user_id', 'slug'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
