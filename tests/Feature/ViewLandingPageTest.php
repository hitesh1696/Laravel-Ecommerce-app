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
        //Arrange

        //Act
        $response = $this->get('/');

        //Assert
        $response->assertStatus(200);
        $response->assertSee('Laravel Ecommerce');
        $response->assertSee('Includes multiple products');
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

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertDontSee($notFeaturedProduct->name);
        $response->assertDontSee('$1499.99');
    }
}
