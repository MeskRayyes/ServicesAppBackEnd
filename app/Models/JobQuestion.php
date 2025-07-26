<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'question_text',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}


