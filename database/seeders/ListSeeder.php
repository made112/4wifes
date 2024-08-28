<?php

namespace Database\Seeders;

use App\Models\Lists;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Lists::create([
            'title' => 'Sample List One Hour',
            'description' => 'This is a sample list with one hour reminder.',
            'date' => '2023-09-09 18:43:00', // Current date and time
            'reminder_hour' => 'three_hour',
            'house_id' => 33,
            'code' => 'calendar',
            'reminder_day' => 'two_day', // Matching 'two_day' in the query

        ]);
    }
}
