<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public static function convertBase64ImageToFile($base64_string){
        $image_parts = explode(';base64,', $base64_string);
        $image_types_aux = explode('image/', $image_parts[0]);
        $image_ext = $image_types_aux[1];
        $output_file = "tmp." . $image_ext;

        $ifp = fopen($output_file, 'wb'); 
        fwrite($ifp, base64_decode($image_parts[1]));
        fclose($ifp); 
        return $output_file;
    }

    public static function saveImageToLocal($image, $contestant){
        if(preg_match('/^data:image\/(\w+);base64,/', $image)){
            $data = substr($image, strpos($image, ',') + 1);
            $decoded_image = base64_decode($data);            

            // store image in folder
            $filename = strtolower($contestant->name . '-' . time() . '.jpg');
            Storage::disk('contestant')->put($filename, $decoded_image);
            return [
                "upload_complete" => true,
                "filename" => $filename
            ];
        }
        return [
            "upload_complete" => false,
        ];
    }
}
