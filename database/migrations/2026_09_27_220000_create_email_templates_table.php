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
        if (!Schema::hasTable('email_templates')) {
            Schema::create('email_templates', function (Blueprint $table) {
                $table->id();
                $table->string('key', 100)->unique();
                $table->string('name', 191);
                $table->string('category', 100)->default('General');
                $table->string('recipient_type', 20)->default('user');
                $table->string('subject', 255);
                $table->text('preheader')->nullable();
                $table->string('greeting', 255)->nullable();
                $table->longText('body');
                $table->string('action_text', 100)->nullable();
                $table->string('action_url', 255)->nullable();
                $table->text('footer_text')->nullable();
                $table->json('available_tags')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            try {
                \App\Models\EmailTemplate::seedDefaults();
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
};
