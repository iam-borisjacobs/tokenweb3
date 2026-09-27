<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Settings;
use Livewire\Livewire;
use App\Http\Livewire\Admin\ThemeDisplay;

class FrontendAndDataIntegrityTest extends TestCase
{
    public function test_ecx_frontend_pages_render_without_errors()
    {
        $settings = Settings::first();
        $this->assertNotNull($settings);

        // Ensure ecx template is active
        $settings->update(['frontend_template' => 'ecx']);

        $routes = [
            '/',
            '/about',
            '/services',
            '/contact',
            '/faq',
            '/terms',
            '/privacy',
            '/security',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $this->assertEquals(200, $response->status(), "Route {$route} failed with status {$response->status()}");
            $response->assertSee($settings->site_name);
        }
    }

    public function test_default_frontend_template_switching()
    {
        $settings = Settings::first();

        // Switch to default
        $settings->update(['frontend_template' => 'default']);
        $response = $this->get('/');
        $this->assertEquals(200, $response->status());

        // Switch back to ecx
        $settings->update(['frontend_template' => 'ecx']);
        $response = $this->get('/');
        $this->assertEquals(200, $response->status());
        $response->assertSee('ECX Groups');
    }

    public function test_theme_display_livewire_component_switches_templates()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');

        Livewire::test(ThemeDisplay::class)
            ->call('setFrontendTemplate', 'default')
            ->assertSet('frontend_template', 'default');

        $this->assertEquals('default', Settings::first()->frontend_template);

        Livewire::test(ThemeDisplay::class)
            ->call('setFrontendTemplate', 'ecx')
            ->assertSet('frontend_template', 'ecx');

        $this->assertEquals('ecx', Settings::first()->frontend_template);
    }

    public function test_user_data_and_investments_integrity()
    {
        // Check user count is 25
        $userCount = User::count();
        $this->assertEquals(25, $userCount, "Expected 25 users in database");

        // Verify specific user Jboris260 (id 18717)
        $boris = User::where('username', 'Jboris260')->orWhere('id', 18717)->first();
        $this->assertNotNull($boris, "User Jboris260 / id 18717 must exist");

        // Test authenticated dashboard routes
        $response = $this->actingAs($boris)->get('/dashboard');
        $this->assertEquals(200, $response->status(), "User dashboard failed with {$response->status()}");

        $response = $this->actingAs($boris)->get('/dashboard/buy-plan');
        $this->assertEquals(200, $response->status(), "Buy plan failed with {$response->status()}");

        $response = $this->actingAs($boris)->get('/dashboard/accounthistory');
        $this->assertEquals(200, $response->status(), "Account history failed with {$response->status()}");
    }

    public function test_admin_dashboard_pages()
    {
        $admin = Admin::first();
        $this->assertNotNull($admin);

        $adminRoutes = [
            '/admin/dashboard',
            '/admin/dashboard/manageusers',
            '/admin/dashboard/plans',
            '/admin/dashboard/settings/app-settings',
        ];

        foreach ($adminRoutes as $route) {
            $response = $this->actingAs($admin, 'admin')->get($route);
            $this->assertEquals(200, $response->status(), "Admin route {$route} failed with status {$response->status()}");
        }
    }
}
