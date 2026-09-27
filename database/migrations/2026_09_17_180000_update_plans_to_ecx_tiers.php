<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePlansToEcxTiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $planConfigs = [
            10 => [
                'name' => 'BRONZE PLAN',
                'price' => 1000,
                'min_price' => 100,
                'max_price' => 4999,
                'minr' => 20,
                'maxr' => 25,
                'expected_return' => '140%',
                'increment_amount' => 20,
                'increment_interval' => 'Daily',
                'increment_type' => 'Percentage',
                'expiration' => '7 Days',
                'type' => 'Main',
                'category' => 'crypto',
                'image' => 'photos/plan_bronze_ecx.jpg',
            ],
            11 => [
                'name' => 'SILVER PLAN',
                'price' => 10000,
                'min_price' => 5000,
                'max_price' => 24999,
                'minr' => 40,
                'maxr' => 45,
                'expected_return' => '560%',
                'increment_amount' => 40,
                'increment_interval' => 'Daily',
                'increment_type' => 'Percentage',
                'expiration' => '14 Days',
                'type' => 'Main',
                'category' => 'crypto',
                'image' => 'photos/plan_silver_ecx.jpg',
            ],
            12 => [
                'name' => 'GOLD PLAN',
                'price' => 50000,
                'min_price' => 25000,
                'max_price' => 74999,
                'minr' => 60,
                'maxr' => 65,
                'expected_return' => '1260%',
                'increment_amount' => 60,
                'increment_interval' => 'Daily',
                'increment_type' => 'Percentage',
                'expiration' => '21 Days',
                'type' => 'Main',
                'category' => 'crypto',
                'image' => 'photos/plan_gold_ecx.jpg',
            ],
            13 => [
                'name' => 'DIAMOND PLAN',
                'price' => 100000,
                'min_price' => 75000,
                'max_price' => 150000,
                'minr' => 80,
                'maxr' => 90,
                'expected_return' => '2400%',
                'increment_amount' => 80,
                'increment_interval' => 'Daily',
                'increment_type' => 'Percentage',
                'expiration' => '30 Days',
                'type' => 'Main',
                'category' => 'crypto',
                'image' => 'photos/plan_diamond_ecx.jpg',
            ],
        ];

        foreach ($planConfigs as $id => $data) {
            $exists = DB::table('plans')->where('id', $id)->first();
            if ($exists) {
                DB::table('plans')->where('id', $id)->update(array_merge($data, ['updated_at' => now()]));
            } else {
                DB::table('plans')->insert(array_merge(['id' => $id, 'created_at' => now(), 'updated_at' => now()], $data));
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Keep plans
    }
}
