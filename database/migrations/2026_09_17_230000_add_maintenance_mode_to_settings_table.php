<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `settings` ROW_FORMAT=DYNAMIC");
        } catch (\Throwable $e) {
            // Ignore if already dynamic or permission restricted
        }

        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'maintenance_mode')) {
                $table->boolean('maintenance_mode')->default(false);
            }
            if (!Schema::hasColumn('settings', 'maintenance_title')) {
                $table->text('maintenance_title')->nullable();
            }
            if (!Schema::hasColumn('settings', 'maintenance_message')) {
                $table->text('maintenance_message')->nullable();
            }
            if (!Schema::hasColumn('settings', 'maintenance_until')) {
                $table->dateTime('maintenance_until')->nullable();
            }
            if (!Schema::hasColumn('settings', 'maintenance_secret')) {
                $table->text('maintenance_secret')->nullable();
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
            $table->dropColumn([
                'maintenance_mode',
                'maintenance_title',
                'maintenance_message',
                'maintenance_until',
                'maintenance_secret',
            ]);
        });
    }
};
