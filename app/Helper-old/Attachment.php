<?php


namespace Helper;

use App\Models\Order;
use App\Models\Page;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Mockery\Exception;


class Attachment
{

    private $imageExtensions = [
        'jpg',
        'jpeg',
        'gif',
        'png',
        'bmp',
        'svg',
        'svgz',
        'cgm',
        'djv',
        'djvu',
        'ico',
        'ief',
        'jpe',
        'pbm',
        'pgm',
        'pnm',
        'ppm',
        'ras',
        'rgb',
        'tif',
        'tiff',
        'wbmp',
        'xbm',
        'xpm',
        'xwd'
    ];

    /**
     * @param $key
     * @param $array
     * @param $value
     * @return mixed
     */
    static function inArray($key, $array, $value)
    {
        $return = array_key_exists($key, $array) ? $array[$key] : $value;
        return $return;
    }

    /**
     * @param $file
     * @param $model
     * @param $folder_name
     * @param array $options
     */
    static function addAttachment($file, $model, $folder_name, array $options = []): void
    {
        $relation = self::inArray('relation', $options, 'attachmentRelation');
        $type = self::inArray('type', $options, 'null');
        $cover_image = self::inArray('cover_image', $options, '0');

        $folder_name = $folder_name . '/' . Carbon::now()->toDateString();
        $path = null;
        $disk = 'public';
        $path = 'storage/' . $file->store($folder_name, $disk);
        $model->$relation()->create(
            [
                'path' => $path,
                'type' => $type,
                'cover_image' => $cover_image,

            ]
        );

        return;
    }


    static function deleteAttachment($model, $relation = 'attachmentRelation', $multiple = false)
    {


        $photos = $model->$relation;

        if ($multiple == true) {
            foreach ($photos as $photo) {

                if (file_exists($photo->path)) {
                    unlink($photo->path);
                }
                $photo->delete();
            }
            return true;
        } else {
            if ($photos)
                if (file_exists($photos->path)) {
                    unlink($photos->path);
                }
        }

        $model->$relation()->delete();
    }
}
