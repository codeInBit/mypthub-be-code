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
        // $this->call(UsersTableSeeder::class);
        if (DB::table('oauth_clients')->count() < 1) {
            Artisan::call('passport:install');
        }
        $this->call(DemoSeeder::class);
    }
}
