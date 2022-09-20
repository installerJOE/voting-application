<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contest(){
        return $this->belongsTo(Contest::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

}
