<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 3)->create()->each(function ($user) {
            $user->parties()->saveMany(
                factory(App\Party::class, rand(1,5))->make()
            )->each(function ($party) {
                $party->members()->saveMany(
                    factory(App\Member::class, rand(1,5))->make()
                );
            });
        });
    }
}
