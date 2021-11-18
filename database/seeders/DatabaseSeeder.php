<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Psy\Util\Str;
use function random_int;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
           NewsSeeder::class,
        ]);
    }
}
