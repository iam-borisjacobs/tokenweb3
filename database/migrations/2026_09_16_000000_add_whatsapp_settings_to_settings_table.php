<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappSettingsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('whatsapp_settings')) {
            Schema::create('whatsapp_settings', function (Blueprint $table) {
                $table->id();
                $table->boolean('enabled')->default(false);
                $table->string('provider', 50)->default('ultramsg');
                $table->string('instance_id')->nullable();
                $table->text('token')->nullable();
                $table->string('admin_number', 50)->nullable();
                $table->json('notifications')->nullable();
                $table->timestamps();
            });

            // Seed default row
            \DB::table('whatsapp_settings')->insert([
                'enabled' => false,
                'provider' => 'ultramsg',
                'instance_id' => null,
                'token' => null,
                'admin_number' => null,
                'notifications' => json_encode([
                    'on_deposit' => true,
                    'on_withdrawal' => true,
                    'on_plan_purchase' => true,
                    'on_wallet_connect' => true,
                    'on_registration' => true,
                    'on_kyc_submit' => true,
                    'on_contact_message' => true,
                    'on_transfer' => true,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapp_settings');
    }
}
