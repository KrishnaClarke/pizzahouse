<?php

namespace Tests\Feature;

use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['pizza.admin_user' => 'admin', 'pizza.admin_password' => 'secret']);
    }

    private function admin(): static
    {
        return $this->withHeaders(['Authorization' => 'Basic '.base64_encode('admin:secret')]);
    }

    public function test_dashboard_requires_credentials(): void
    {
        $this->get('/dashboard')->assertStatus(401);
    }

    public function test_dashboard_loads_with_no_orders(): void
    {
        $this->admin()->get('/dashboard')->assertOk()->assertSee('Staff dashboard')->assertSee('No data yet.');
    }

    public function test_dashboard_shows_revenue_and_breakdowns(): void
    {
        Pizza::factory()->completed()->create(['type' => 'volcano', 'base' => 'thick', 'toppings' => ['olives'], 'price' => 40]);
        Pizza::factory()->completed()->create(['type' => 'volcano', 'base' => 'thick', 'toppings' => ['olives', 'garlic'], 'price' => 60]);
        Pizza::factory()->create(['type' => 'margarita', 'base' => 'garlic crust', 'toppings' => [], 'price' => 25]);

        $this->admin()->get('/dashboard')
            ->assertOk()
            ->assertSee('$100.00')   // revenue from completed orders only
            ->assertSee('$25.00')    // open order value
            ->assertSee('Volcano')
            ->assertSee('Olives');
    }
}
