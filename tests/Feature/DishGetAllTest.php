<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishGetAllTest extends TestCase
{
    use RefreshDataBase;
    public function test_making_an_api_get_all()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create(['title' => 'arepa']);

        $response = $this->getJson('/api/dishes');
        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => 'arepa']);                        
    }
}
