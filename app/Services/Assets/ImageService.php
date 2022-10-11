<?php

namespace App\Services\Assets;

use App\Models\Image;

class ImageService
{
    // upload image using local driver        
    public function uploadAndSaveImage($data, $imageToBeUpdated){
        $cover_image_flag = $data["cover_image"];
        $model = $data["imageable"];
        $updateImage = $data["update_image"];  
        $modelAttribute = $data["filenameAttribute"];
        $image = $data["image"];
        
        $imageUrl = Image::saveImageToLocal($image, $model->$modelAttribute);
        if($imageUrl === null) return false;
        
        $existingCoverImage = $model->images()->where('cover_image', true)->first();

        if($updateImage && $imageToBeUpdated !== null){
            $imageToBeUpdated->update([
                "image_url" => $imageUrl,
                "cover_image" => $imageToBeUpdated == $existingCoverImage ? true : $cover_image_flag
            ]);
        } 
        else{
            $model->images()->create([
                "image_url" => $imageUrl,
                "cover_image" => $existingCoverImage != null ? false : $cover_image_flag
            ]);
        }
        return true;
    }
}