<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WalletType;

class WalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonPath = resource_path('data/wallets.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $wallets = json_decode(file_get_contents($jsonPath), true);
        if (!is_array($wallets)) {
            return;
        }

        foreach ($wallets as $index => $w) {
            WalletType::updateOrCreate(
                ['name' => $w['name']],
                [
                    'icon' => $w['icon'],
                    'status' => 'enabled',
                    'sort_order' => $index,
                ]
            );
        }
    }
}
