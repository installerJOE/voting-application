<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contestant_number',
        'profile_overview',
        'user_id',
        'status',
    ];

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

    // upload using cloudinary
    public function save_image_using_cloudinary($image){
        $output_file = Image::convertBase64ImageToFile($image);
        $imageUrl = Cloudinary::upload($output_file, [
            'folder' => 'voting_app/contestants'
        ])->getSecurePath(); 
        parent::save_image($imageUrl);
        return true;
    }

    // upload using local driver
    public function save_image_to_storage($image){
        $image_file = $image["image"];
        $cover_image = $image["cover_image"];
        
        $output_file = Image::saveImageToLocal($image_file, $this->name);
        if($output_file["upload_complete"]){
            $this->save_image($output_file["filename"], $cover_image);
            return true;
        }
        return false;
    }

    private function save_image($imageUrl, $cover_image){
        $this->images()->create([
            "image_url" => $imageUrl,
            "cover_image" => $cover_image
        ]);
    }

    public static function generate_contestant_no(){
        do {
            $number = random_int(10000, 99999);   
        }
        while (Contestant::where('contestant_number', $number)->first());
        return $number;
    }

}
