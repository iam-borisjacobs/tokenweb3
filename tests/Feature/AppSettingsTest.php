<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Settings;

class AppSettingsTest extends TestCase
{
    public function test_app_settings_page_loads_successfully()
    {
        $admin = Admin::first();
        $this->assertNotNull($admin, 'Admin user must exist in database');

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/dashboard/settings/app-settings');

        if ($response->status() !== 200) {
            echo "\nError Status: " . $response->status() . "\n";
            echo "Content snippet:\n" . substr($response->getContent(), 0, 1500) . "\n";
        }

        $response->assertStatus(200);
        $response->assertSee('Website information settings');
        $response->assertSee('ecx');
    }
}
