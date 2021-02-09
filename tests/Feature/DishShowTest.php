<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishShowTest extends TestCase
{
    use RefreshDataBase;
    public function test_making_an_api_show()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create(['title' => 'arepa']);

        $response = $this->getJson('/api/dishes/1');
        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => 'arepa']);
            
    }
    public function test_making_an_api_show_fails()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create(['title' => 'arepa']);

        $response = $this->getJson('/api/dishes/100');
        $response
            ->assertStatus(404)
            ->assertJsonFragment(['message'=>'dish not found']);            
    }

}
