<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('curriculums')->truncate();
        DB::table('delivery_times')->truncate();
        DB::table('grades')->truncate();

        $this->call([
            CurriculumSeeder::class,
            DeliveryTimeSeeder::class,
            GradeSeeder::class,
        ]);
    }
}
