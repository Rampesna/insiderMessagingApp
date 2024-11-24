<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageApiTest extends TestCase
{
    public function test_index_endpoint_returns_data()
    {
        $response = $this->getJson('/api/message/index?limit=10&isSent=1');
        $response->assertStatus(200)->assertJsonStructure(['*' => ['id', 'text']]);
    }

    public function test_getById_endpoint_returns_correct_message()
    {
        $response = $this->getJson('/api/message/getById?id=1');
        $response->assertStatus(200)->assertJson(['id' => 1, 'text' => 'Hello World']);
    }
}
