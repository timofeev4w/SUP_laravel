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

        for ($i=0; $i < 7; $i++) { 
            $created_at = date('Y-m-d H:i:s', time() - mt_rand(100, 5000000));
            $updated_at = date('Y-m-d H:i:s', strtotime($created_at.' + 3 days'));
            DB::table('clients')->insert([
                'secondname' => $second_names[array_rand($second_names)],
                'firstname' => $first_names[array_rand($first_names)],
                'patronymic' => $patronymics[array_rand($patronymics)],
                'email' => Str::random(10).'@gmail.com',
                'phone' => '+79'.mt_rand(100000000, 999999999),
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}
