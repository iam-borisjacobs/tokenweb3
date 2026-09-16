<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteColorPaletteToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'site_accent_color')) {
                $table->string('site_accent_color', 30)->default('#D61C4E')->after('website_theme');
            }
            if (!Schema::hasColumn('settings', 'site_secondary_color')) {
                $table->string('site_secondary_color', 30)->default('#9F1239')->after('site_accent_color');
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
            $table->dropColumn(['site_accent_color', 'site_secondary_color']);
        });
    }
}
