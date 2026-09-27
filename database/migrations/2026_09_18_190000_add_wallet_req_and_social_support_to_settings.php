<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWalletReqAndSocialSupportToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'require_wallet_for_investment')) {
                $table->boolean('require_wallet_for_investment')->default(true)->after('trade_mode');
            }
            if (!Schema::hasColumn('settings', 'whatsapp_number')) {
                $table->text('whatsapp_number')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('settings', 'telegram_username')) {
                $table->text('telegram_username')->nullable()->after('whatsapp_number');
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
            if (Schema::hasColumn('settings', 'require_wallet_for_investment')) {
                $table->dropColumn('require_wallet_for_investment');
            }
            if (Schema::hasColumn('settings', 'whatsapp_number')) {
                $table->dropColumn('whatsapp_number');
            }
            if (Schema::hasColumn('settings', 'telegram_username')) {
                $table->dropColumn('telegram_username');
            }
        });
    }
}
