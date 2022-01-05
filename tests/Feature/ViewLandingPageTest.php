<?php

namespace Tests\Feature;

use App\Models\Product;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewLandingPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function landing_page_loads_correctly()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function featured_product_is_visible()
    {
        // Arrange
        $featuredProduct = Product::factory()->create([
            'featured' => true,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertSee($featuredProduct->name);
        $response->assertSee('$1499.99');
    }

    /** @test */
    public function not_featured_product_is_not_visible()
    {
        // Arrange
        $notFeaturedProduct = Product::factory()->create([
            'featured' => false,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);
        $response = $this->get('/');
        $response->assertDontSee($notFeaturedProduct->name);
        $response->assertDontSee('$1499.99');
    }
}
