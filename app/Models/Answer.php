<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'user_id', 'question_id', 'is_best'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    // relationship with vote
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
