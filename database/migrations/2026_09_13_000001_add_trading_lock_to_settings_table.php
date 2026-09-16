<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTradingLockToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'min_trading_balance')) {
                $table->decimal('min_trading_balance', 15, 2)->default(100000.00)->after('currency');
            }
            if (!Schema::hasColumn('settings', 'trading_lock_enabled')) {
                $table->boolean('trading_lock_enabled')->default(true)->after('min_trading_balance');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['min_trading_balance', 'trading_lock_enabled']);
        });
    }
}
