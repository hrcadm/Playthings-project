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
        $this->call(UsersTableSeeder::class);
        $this->call(VwfactoriesTableSeeder::class);
        $this->call(VwitemsTableSeeder::class);
        $this->call(VwlabsTableSeeder::class);
        $this->call(VwrptitemtestspassedTableSeeder::class);
        $this->call(VwstandardsTableSeeder::class);
        $this->call(VwvendorsTableSeeder::class);
    }
}
