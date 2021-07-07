<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/item');
        $item = Item::factory()->create();
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $item->name,
            'file_path' => $item->file_path,
            'price' => $item->price
        ]);
    }
}
