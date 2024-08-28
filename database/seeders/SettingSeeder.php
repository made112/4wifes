<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'privacy',
                'label' => 'سياسات وخصوصية',
                'value' => 'سياسات وخصوصية',
                'group' => 'social',
            ],
            [
                'key' => 'whats-app',
                'label' => 'واتس اب',
                'value' => '+969858747123',
                'group' => 'social',
            ],

            [
                'key' => 'synchronization',
                'label' => 'تفعيل المزامنة',
                'value' => '1',
                'group' => 'general',
            ],
        ];

        foreach ($data as $key => $value) {
            Setting::create([
                'key' => $value['key'],
                'label' => $value['label'],
                'value' => $value['value'],
                'group' => $value['group'],
            ]);
        }
    }
}
