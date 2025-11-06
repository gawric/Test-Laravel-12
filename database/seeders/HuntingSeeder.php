<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $now = Carbon::now();

    
        $guideIds = DB::table('guides')->pluck('id')->toArray();

        if (empty($guideIds)) {
            $this->command->info('No guide found — hunting bookings seeder skipped.');
            return;
        }

        $tourTypes = [
            'Охота на уток', 'Дневная охота', 'Ночная вылазка',
            'По зайцу', 'По кабану', 'Летняя охота', 'Зимний тур'
        ];

        $hunterNames = [
            'Иван', 'Пётр', 'Сергей', 'Андрей', 'Михаил',
            'Алексей', 'Дмитрий', 'Николай', 'Владимир', 'Егор'
        ];

        $bookings = [];

        for ($i = 0; $i < 10; $i++) {
            $bookings[] = [
                'tour_name' => $tourTypes[array_rand($tourTypes)] . ' #' . ($i + 1),
                'hunter_name' => $hunterNames[array_rand($hunterNames)] . ' ' . mb_substr(uniqid(), -4),
                'guide_id' => $guideIds[array_rand($guideIds)],
                'date' => Carbon::today()->addDays(rand(1, 180))->toDateString(),
                'participants_count' => rand(1, 6),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('hunting')->insert($bookings);

        $this->command->info('Inserted ' . count($bookings) . ' hunting bookings.');
    }
}
