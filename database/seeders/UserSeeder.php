<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = User::create([
            'name' => 'Joko',
            'email' => 'joko@cargether.test',
            'password' => 'bcrypt'('password')
        ]);

        $owner->assignRole('owner');

        $treasurer = User::create([
            'name' => 'Akbar',
            'email' => 'akbar@cargether.test',
            'password' => 'bcrypt'('password')
        ]);

        $treasurer->assignRole('treasurer');

        $staff = User::create([
            'name' => 'Rani',
            'email' => 'rani@cargether.test',
            'password' => 'bcrypt'('password')
        ]);

        $staff->assignRole('staff');
    }
}
