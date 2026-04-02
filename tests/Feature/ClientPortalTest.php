<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_middleware_blocks_non_clients()
    {
        // Create role if not exists
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::factory()->create();
        $user->assignRole($adminRole);

        $this->actingAs($user)
            ->get(route('client.dashboard'))
            ->assertStatus(403);
    }

    public function test_client_can_access_dashboard()
    {
        // Create client role
        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        $user = User::factory()->create();
        $user->assignRole($clientRole);

        Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);

        $this->actingAs($user)
            ->get(route('client.dashboard'))
            ->assertStatus(200);
    }
}
