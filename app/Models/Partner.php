<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'sender_name',
        'job_role'
    ];

    public function contests(){
        return $this->belongsToMany(Contest::class);
    }
}
