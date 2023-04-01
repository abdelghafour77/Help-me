<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'answer_id', 'is_upvote'];

    // relationship with answer
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
