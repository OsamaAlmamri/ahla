<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        Model::unguard();
        $this->call(UserTableSeeder::class);
//        $this->call(UserTableSeeder::class);
//        $this->command->info('User table seeded!');
//        $this->call(SettingTablesSeeder::class);

        $this->command->info('SettingTablesSeeder seeded!');

    }
}
