<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function contestants(){
        return $this->hasMany(Contestant::class);
    }
}
