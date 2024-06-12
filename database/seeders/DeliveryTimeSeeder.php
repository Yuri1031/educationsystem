<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeliveryTimeSeeder extends Seeder
{
    public function run()
    {
        $delivery_times = [
            [
                'curriculums_id' => 1,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 2,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 3,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 4,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 5,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 6,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 7,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 8,
                'delivery_from' => Carbon::now()->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 9,
                'delivery_from' => Carbon::now()->subMonth(1)->format('Y-m-d'),
                'delivery_to' => Carbon::now()->subDay(1)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 10,
                'delivery_from' => Carbon::now()->subMonth(1)->format('Y-m-d'),
                'delivery_to' => Carbon::now()->subDay(1)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 11,
                'delivery_from' => Carbon::now()->addMonth(1)->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth(2)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 12,
                'delivery_from' => Carbon::now()->addMonth(1)->format('Y-m-d'),
                'delivery_to' => Carbon::now()->addMonth(2)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('delivery_times')->insert($delivery_times);
    }
}
