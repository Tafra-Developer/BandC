<?php

namespace Helper;

use App\Models\Setting as ModelsSetting;

class Setting
{
    public static function settingKey($key)
    {
        return ModelsSetting::where('key', $key)->first()?->value ?? '';
    }
}
