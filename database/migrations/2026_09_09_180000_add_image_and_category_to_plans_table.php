<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAndCategoryToPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            if (!Schema::hasColumn('plans', 'image')) {
                $table->string('image')->nullable()->after('name');
            }
            if (!Schema::hasColumn('plans', 'category')) {
                $table->string('category')->default('crypto')->after('image');
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
        Schema::table('plans', function (Blueprint $table) {
            if (Schema::hasColumn('plans', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('plans', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}
