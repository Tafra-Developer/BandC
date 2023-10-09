<?php

namespace Helper;

use App\Models\Setting as ModelsSetting;

class Setting
{
    public static function settingKey($key)
    {
        $data = ModelsSetting::where('key', $key)->first();
        if ($data) {
            return $data->value;
        }
        return '';
    }
}
