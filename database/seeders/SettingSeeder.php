<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Termwind\Components\Dd;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = [
            'app_about' => 'terms_and_conditions',
            'terms_conditions' => 'terms_and_conditions',
            'about_website' => 'about_us',
            'our_goal' => 'about_us',
            'our_goal_2' => 'about_us',
            'future_plans' => 'about_us',
            'short_description_website' => 'contact_us',
            'website' => 'contact_us',
            'mobile_number' => 'contact_us',
            'email' => 'contact_us',
            'fax' => 'contact_us',
            'facebook' => 'contact_us',
            'twitter' => 'contact_us',
            'instagram' => 'contact_us',
            'google' => 'contact_us',




        ];



        foreach ($keys as $key => $value) {
            $old_setting = Setting::where('key', $key)->first();
            if ($old_setting) {
                $replicate = $old_setting->replicateWithTranslations();
                $replicate->save();
                $old_setting->delete();
            } else {
                $setting = Setting::create([
                    'key' => $key,
                    'type' => "text",
                    'page' => $value,

                ]);
            }
        }
    }
}
