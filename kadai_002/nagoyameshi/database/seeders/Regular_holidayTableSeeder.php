<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regular_holiday;

class Regular_holidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $day_indexies = [
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6'
        ];

        $days = [
            '日曜日',
            '月曜日',
            '火曜日',
            '水曜日',
            '木曜日',
            '金曜日',
            '土曜日'
        ];

        foreach ($day_indexies as $index => $day_index) {
            Regular_holiday::create([
                'day_index' => $day_index,
                'day' => $days[$index]
            ]);
        }
    }
}
