<?php

namespace Tests\Feature;

use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PizzaOrderTest extends TestCase
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

    public function test_home_and_order_form_load(): void
    {
        $this->get('/')->assertOk();
        $this->get('/pizzas/create')->assertOk()->assertSee('Build your pizza');
    }

    public function test_customer_can_place_an_order_with_toppings(): void
    {
        $response = $this->post('/pizzas', [
            'name' => 'Xillie',
            'type' => 'hawaiian',
            'base' => 'cheese crust',
            'toppings' => ['olives', 'pepperoni'],
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('pizzas', ['name' => 'Xillie', 'price' => 56.00, 'status' => 'pending']);
        $this->assertSame(['olives', 'pepperoni'], Pizza::first()->toppings);
    }

    public function test_order_without_toppings_does_not_crash(): void
    {
        $this->post('/pizzas', ['name' => 'Sam', 'type' => 'margarita', 'base' => 'thick'])
            ->assertRedirect('/');

        $this->assertSame([], Pizza::first()->toppings);
        $this->admin()->get('/pizzas/'.Pizza::first()->id)->assertOk()->assertSee('None');
    }

    public function test_invalid_orders_are_rejected(): void
    {
        $this->post('/pizzas', ['name' => '', 'type' => 'pineapple', 'base' => 'stuffed'])
            ->assertSessionHasErrors(['name', 'type', 'base']);

        $this->assertDatabaseCount('pizzas', 0);
    }

    public function test_staff_pages_require_credentials(): void
    {
        $pizza = Pizza::factory()->create();

        $this->get('/pizzas')->assertStatus(401);
        $this->get('/pizzas/'.$pizza->id)->assertStatus(401);
        $this->delete('/pizzas/'.$pizza->id)->assertStatus(401);
        $this->assertDatabaseCount('pizzas', 1);
    }

    public function test_staff_can_list_complete_and_cancel_orders(): void
    {
        $pizza = Pizza::factory()->create(['name' => 'Zara']);

        $this->admin()->get('/pizzas')->assertOk()->assertSee('Zara');

        $this->admin()->patch("/pizzas/{$pizza->id}/complete")->assertRedirect('/pizzas');
        $this->assertTrue($pizza->fresh()->isCompleted());

        $this->admin()->delete("/pizzas/{$pizza->id}")->assertRedirect('/pizzas');
        $this->assertDatabaseMissing('pizzas', ['id' => $pizza->id]);
    }

    public function test_missing_order_returns_404(): void
    {
        $this->admin()->get('/pizzas/999')->assertNotFound();
    }
}
