<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class CreateSettingSeeder     extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SettingRecords = [
            ['id'=>1,'facebook'=>'https://www.facebook.com/','instagram'=>'https://www.instagram.com/','youtube'=>'https://www.youtube.com/','twitter'=>'https://twitter.com/','email'=>'test@gmail.com','image'=>'test.jpg','about'=>'something content'],
          
          
        ];
        Setting::insert($SettingRecords);
    }
}
