<?php

namespace Database\Seeders;

use App\Models\General\User;
use App\Models\Visitor;
use Database\Factories\VisitorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('users')->delete();

        // SuperAdmin
//        User::updateOrCreate(['id' => '1',],[
//            'name'     => 'Osama',
//            'active'   => 1,
//            'email'    => 'yemencoder@gmail.com',
//            'password' => Hash::make('12345678')
//        ]);

        $users = Visitor::test_models_can_be_instantiated();
    }
}
