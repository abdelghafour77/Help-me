<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'reportable_type',
        'reportable_id',
        'user_id',
        'report_type_id',
        'description',
        'is_resolved',
        'resolved_by',
        'question_id',
        'reported_at',
    ];

    public function reportable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }
    // question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
