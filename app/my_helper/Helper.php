<?php


namespace App\my_helper;


use Carbon\Carbon;

class Helper
{


    static function convertDateTime($dateTime)
    {
        $date = Carbon::parse($dateTime)->format('Y-m-d 00:00:00');

        return $date;
    }


    static function activation($model)
    {
        if ($model->activation == 1) {
            $model->activation = 0;
            $model->save();

        } else {
            $model->activation = 1;
            $model->save();
        }

        return true;
    }

    static function activationView($model, $url , $on_red = 'الغاء التفعيل' , $on_blue = 'تفعيل' )
    {
        $onclick = 'onclick="myFunction('.$model->id.')"';
        if ($model->activation == 1 && $on_blue != 'قبول') {
            return '<a class="btn btn-danger" href="' . $url . '" id="btn_'.$model->id.'" '.$onclick.'>
                         '.$on_red.'
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '" id="btn_'.$model->id.'" '.$onclick.'>
                        '.$on_blue.'
                    </a>';
        }
    }


    static function is_read($model)
    {
        if($model->is_read == 0)
        {
            $model->is_read = 1;
            $model->save();
            return true;
        }else
        {
            return false;
        }
    }


}