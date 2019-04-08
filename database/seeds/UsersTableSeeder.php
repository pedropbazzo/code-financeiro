<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeFinance\Models\User::class,1)
            ->states('admin')
            ->create([
                'name'  => 'Andre Silva - Admin',
                'email' => 'admin@user.com'
            ]);

        factory(\CodeFinance\Models\User::class,1)
            ->states('client')
            ->create([
                'name'  => 'Jon Snow - Cliente',
                'email' => 'client@user.com'
            ]);
    }
}
