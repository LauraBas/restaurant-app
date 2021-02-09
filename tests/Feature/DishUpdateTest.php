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
        $dish = Dish::factory()->create(['title' => 'arroz']);
        $dish = ['title' => 'arepa', 'description'=>'rica','price'=>'5.12'];
        $response = $this->putJson('/api/dishes/1', $dish );
        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title' => 'arepa']);
            
    }
}
