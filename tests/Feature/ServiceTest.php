<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_can_be_created(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/admin/services', [
                'title' => 'Test Service',
                'description' => 'This is a test service.',
                'icon' => '🚀',
                'price' => '$100',
                'show_price' => '1',
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'title' => 'Test Service',
            'icon' => '🚀',
        ]);
    }
}
