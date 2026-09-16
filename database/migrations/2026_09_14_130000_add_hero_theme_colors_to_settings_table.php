<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeroThemeColorsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'hero_accent_color')) {
                $table->string('hero_accent_color', 30)->default('#F59E0B')->after('website_theme');
            }
            if (!Schema::hasColumn('settings', 'hero_secondary_color')) {
                $table->string('hero_secondary_color', 30)->default('#D97706')->after('hero_accent_color');
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
            $table->dropColumn(['hero_accent_color', 'hero_secondary_color']);
        });
    }
}
