<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_making_an_api_post()
    {
        $this->withoutExceptionHandling();
        $dish = [
            'title' => 'empanada',
            'description' => 'rica',
            'price' => 2.20,
        ];
       
        $response = $this->postJson(route('dishes', $dish));

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['title' => 'empanada']);
        $this->assertDatabaseCount('dishes', 1);
        $this->assertDatabaseHas('dishes',['title' => 'empanada']);
            
    }

}
