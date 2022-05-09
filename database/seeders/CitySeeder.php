<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Бугульма',
            'Буденновск',
            'Бузулук',
            'Буйнакск',
            'Великие Луки',
            'Великий Новгород',
            'Верхняя Пышма',
            'Видное',
            'Владивосток',
            'Губкин',
            'Гудермес',
            'Гуково',
            'Гусь-Хрустальный',
            'Дербент',
            'Дзержинск',
            'Димитровград',
            'Дмитров',
            'Долгопрудный',
        ];
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => $city
            ]);
        }
    }
}
