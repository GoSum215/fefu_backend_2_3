<?php

namespace Database\Seeders;
use Psy\Util\Str;
use function random_int;

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        \App\Models\News::query()->delete();
        \App\Models\News::factory(random_int(15, 25))->create();
    }
}
