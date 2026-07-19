<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database if necessary or prepare roles if your app needs them
        $this->artisan('db:seed');
    }

    public function test_web_routes_render_blade_and_do_not_output_json(): void
    {
        $user = User::factory()->create();

        $webRoutes = [
            '/dashboard',
            '/products',
            '/categories',
            '/inventories',
            '/sales',
            '/transactions',
            '/customers',
            '/employees',
            '/branches',
            '/reports',
            '/about',
        ];

        foreach ($webRoutes as $route) {
            $response = $this->actingAs($user)->get($route);

            $response->assertOk();
            // Assert it doesn't return JSON structure (it should return HTML)
            $response->assertHeader('content-type', 'text/html; charset=UTF-8');
            $this->assertStringNotContainsString('"success":', $response->getContent());
        }
    }

    public function test_api_routes_return_json(): void
    {
        $apiRoutes = [
            '/api/v1/products',
            '/api/v1/customers',
            '/api/v1/sales',
            '/api/v1/inventories',
            '/api/v1/transactions',
        ];

        foreach ($apiRoutes as $route) {
            // Note: Since API routes are protected by auth/middleware in some cases, 
            // but these api resources are public or sanctum. Let's hit them and verify they return JSON.
            $response = $this->getJson($route);

            // They should return JSON format regardless of status (e.g., 200 or 401)
            $response->assertHeader('content-type', 'application/json');
        }
    }
}
