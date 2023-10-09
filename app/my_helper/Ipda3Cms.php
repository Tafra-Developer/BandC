<?php


namespace App\my_helper;




use Illuminate\Support\Facades\File;
use \Intervention\Image\Facades\Image;

class Ipda3Cms
{


    static function addPhoto($file , $model , $folder_name)
    {
        $image = $file;
        $destinationPath = public_path().'/uploads/thumbnails/'.$folder_name.'/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original'.time().''.rand(11111,99999).'.'.$extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $image_400 = '400-'.time().''.rand(11111,99999).'.'.$extension;
        $image_600 = '600-'.time().''.rand(11111,99999).'.'.$extension;
        $image_800 = '800-'.time().''.rand(11111,99999).'.'.$extension;

        $resize_image = Image::make($destinationPath.$name);

        $resize_image->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_400 , 100);

        $resize_image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_600 , 100);

        $resize_image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_800 , 100);

        $input =
            [
                'extension' => $extension,
                'original' => 'uploads/thumbnails/'.$folder_name.'/'.$name,
                'photo_400' => 'uploads/thumbnails/'.$folder_name.'/'.$image_400,
                'photo_600' => 'uploads/thumbnails/'.$folder_name.'/'.$image_600,
                'photo_800' => 'uploads/thumbnails/'.$folder_name.'/'.$image_800,
            ];

        $model->photo()->create($input);
    }


    static function updatePhoto($file , $oldFiles , $model , $folder_name)
    {
        if($oldFiles)
        {
            File::delete(public_path() . '/'. $oldFiles->original);
            File::delete(public_path() . '/'. $oldFiles->photo_400);
            File::delete(public_path() . '/'. $oldFiles->photo_600);
            File::delete(public_path() . '/'. $oldFiles->photo_800);
        }

        $image = $file;
        $destinationPath = public_path().'/uploads/thumbnails/'.$folder_name.'/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original'.time().''.rand(11111,99999).'.'.$extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $image_400 = '400-'.time().''.rand(11111,99999).'.'.$extension;
        $image_600 = '600-'.time().''.rand(11111,99999).'.'.$extension;
        $image_800 = '800-'.time().''.rand(11111,99999).'.'.$extension;

        $resize_image = Image::make($destinationPath.$name);

        $resize_image->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_400 , 100);

        $resize_image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_600 , 100);

        $resize_image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$image_800 , 100);

        $input =
            [
                'extension' => $extension,
                'original' => 'uploads/thumbnails/'.$folder_name.'/'.$name,
                'photo_400' => 'uploads/thumbnails/'.$folder_name.'/'.$image_400,
                'photo_600' => 'uploads/thumbnails/'.$folder_name.'/'.$image_600,
                'photo_800' => 'uploads/thumbnails/'.$folder_name.'/'.$image_800,
            ];

        if($oldFiles)
        {
            $model->photo()->update($input);
        }else{

            $model->photo()->create($input);
        }

    }

    static function deletePhoto( $model )
    {
        $photo = $model->photo;

        File::delete(public_path() . '/'. $photo->original);
        File::delete(public_path() . '/'. $photo->photo_400);
        File::delete(public_path() . '/'. $photo->photo_600);
        File::delete(public_path() . '/'. $photo->photo_800);


        $model->photo()->delete();
    }
}