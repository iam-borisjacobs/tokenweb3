<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactChannelsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'phone')) {
                $table->string('phone')->nullable()->after('contact_email');
            }
            if (!Schema::hasColumn('settings', 'map_iframe')) {
                $table->text('map_iframe')->nullable()->after('location');
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
            if (Schema::hasColumn('settings', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('settings', 'map_iframe')) {
                $table->dropColumn('map_iframe');
            }
        });
    }
}
