<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishDeleteTest extends TestCase
{
    use RefreshDataBase;
    public function test_making_an_api_delete()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create(['title' => 'arepa']);

        $response = $this->deleteJson('/api/dishes/1');
        $response
            ->assertStatus(204);
            $this->assertDatabaseCount('dishes', 0);
            $this->assertDatabaseMissing('dishes',['title' => 'empanada']);
    }

    public function test_making_an_api_delete_fails()
    {
        $this->withoutExceptionHandling();
        Dish::factory()->create();

        $response = $this->deleteJson('/api/dishes/10');
        $response
            ->assertStatus(404)
            ->assertJsonFragment(['message'=>'dish not found']);
    }
}
