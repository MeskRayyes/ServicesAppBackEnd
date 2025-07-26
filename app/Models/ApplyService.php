<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
