<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishUpdateTest extends TestCase
{
    use RefreshDataBase;
    public function test_making_an_api_update()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create();
        $dish = ['title' => 'arepa', 'description'=>'rica','price'=>'5.12'];
        $response = $this->patchJson('/api/dishes/1', $dish );
        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => 'arepa']);
        $this->assertDatabaseHas('dishes',['title' => 'arepa']);
            
    }

    public function test_making_an_api_update_fails()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create();
        $dish = ['title' => 'arepa', 'description'=>'rica','price'=>'5.12'];
        $response = $this->patchJson('/api/dishes/100', $dish );
        $response
            ->assertStatus(404)
            ->assertJsonFragment(['message'=>'dish not found']);            
    }
 }
