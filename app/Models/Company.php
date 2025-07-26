<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'Company';

    protected $fillable = [
        'user_id', 'company_name', 'industry', 'established_year', 'tax_license',
        'company_size', 'description', 'phone', 'city', 'address', 'postal_code'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
