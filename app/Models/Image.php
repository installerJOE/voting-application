<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
    ];

    protected $hidden = [
        'imageable_id',
        'imageable_type',
        'updated_at',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
