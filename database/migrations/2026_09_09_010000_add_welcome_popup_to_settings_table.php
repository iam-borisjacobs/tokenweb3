<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWelcomePopupToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'enable_welcome_popup')) {
                $table->string('enable_welcome_popup')->default('yes')->after('enable_annoc');
            }
            if (!Schema::hasColumn('settings', 'welcome_popup_slides')) {
                $table->longText('welcome_popup_slides')->nullable()->after('enable_welcome_popup');
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
            if (Schema::hasColumn('settings', 'welcome_popup_slides')) {
                $table->dropColumn('welcome_popup_slides');
            }
            if (Schema::hasColumn('settings', 'enable_welcome_popup')) {
                $table->dropColumn('enable_welcome_popup');
            }
        });
    }
}
