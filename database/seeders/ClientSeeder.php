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
        for ($i=0; $i < 7; $i++) { 
            $date = date('Y-m-d H:i:s', time() - mt_rand(100, 5000000));
            DB::table('clients')->insert([
                'secondname' => Str::random(10),
                'firstname' => Str::random(10),
                'patronymic' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'phone' => '+79'.mt_rand(100000000, 999999999),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
