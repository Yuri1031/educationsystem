<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use App\Models\DeliveryTime;
use DateTime;
use Illuminate\Database\Seeder;

class DeliveryTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curriculums = Curriculum::all();
        foreach ($curriculums as $curriculum) {
            $day = rand(0, 30);
            $from_hour = rand(9, 17);
            $duration = rand(1, 3);
            $from = new DateTime('2024-06-' . $day . ' ' . $from_hour . ':00:00');
            $to = (clone $from)->modify('+' . $duration . ' hours');
            $data = [
                'curriculums_id' => $curriculum->id,
                'delivery_from' => $from,
                'delivery_to' => $to,
            ];
            DeliveryTime::create($data);
        }
    }
}
