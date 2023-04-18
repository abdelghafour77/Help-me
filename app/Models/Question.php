<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'view_count', 'answer_count', 'user_id'];

    // relationship with tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // relationship with answer
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    // relationship with vote

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
