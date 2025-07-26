<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'job_type',
        'work_place',
        'country',
        'city',
        'experience_from',
        'experience_to',
        'salary_range',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(JobQuestion::class);
    }

    public function skills()
    {
        return $this->hasMany(JobSkill::class);
    }
}
