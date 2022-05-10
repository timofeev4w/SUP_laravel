<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $second_names = [
            'Смирнов',
            'Иванов',
            'Кузнецов',
            'Соколов',
            'Попов',
            'Лебедев',
            'Козлов',
            'Новиков',
            'Морозов',
            'Петров',
            'Волков',
            'Соловьёв',
            'Васильев',
            'Зайцев',
            'Павлов',
            'Семёнов',
            'Голубев',
            'Виноградов',
            'Богданов',
        ];

        $first_names = [
            'Арсений', 
            'Артем', 
            'Артемий', 
            'Артур', 
            'Архип',
            'Виталий', 
            'Влад', 
            'Владимир', 
            'Владислав',
        ];

        $patronymics = [
            'Егорович',
            'Ефимович',
            'Иванович',
            'Феликсович ',
            'Филиппович ',
            'Эдуардович ',
        ];

        // $citeis = [
        //     'Бугульма',
        //     'Буденновск',
        //     'Бузулук',
        //     'Буйнакск',
        //     'Великие Луки',
        //     'Великий Новгород',
        //     'Верхняя Пышма',
        //     'Видное',
        //     'Владивосток',
        //     'Губкин',
        //     'Гудермес',
        //     'Гуково',
        //     'Гусь-Хрустальный',
        //     'Дербент',
        //     'Дзержинск',
        //     'Димитровград',
        //     'Дмитров',
        //     'Долгопрудный',
        // ];

        $addresses = [
            'Нижняя Красносельская, 43, вл. 1',
            'Бакунинская улица, 26-30с1',
            'Госпитальный Вал, 5, стр. 18',
            'Новая Басманная улица, д.15 стр.1',
            'Проспект Мира, д.51',
            'Цветной бульвар, д.21',
            'Гиляровского улица, д.1/3',
            'Б.Грузинская улица, д.62',
            'Кудринская площадь, д.1',
            'Пречистенка улица, д.15',
            'Усачева улица, д.29 кор.9',
            'Новый Арбат улица, д.2',
            'Ружейный переулок, д.4'
        ];

        for ($i=0; $i < 1731; $i++) { 
            $created_at = date('Y-m-d H:i:s', time() - mt_rand(100, 60*60*24*30*5));
            $updated_at = date('Y-m-d H:i:s', strtotime($created_at.' + 3 days'));
            DB::table('clients')->insert([
                'secondname' => $second_names[array_rand($second_names)],
                'firstname' => $first_names[array_rand($first_names)],
                'patronymic' => $patronymics[array_rand($patronymics)],
                'email' => Str::random(10).'@gmail.com',
                'phone' => '+79'.mt_rand(100000000, 999999999),
                'city_id' => mt_rand(1, 18),
                'address' => $addresses[array_rand($addresses)],
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}
