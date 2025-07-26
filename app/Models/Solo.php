<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solo extends Model
{
    protected $table = 'solo';

    protected $fillable = [
        'user_id', 'full_name', 'age', 'gender', 'phone', 'city', 'zip_code',
        'job_title', 'years_of_experience', 'education_level', 'preferred_work_nature', 'skills'
    ];

    protected $casts = [
        'skills' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

