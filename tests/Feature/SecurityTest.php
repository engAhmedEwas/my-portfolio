<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_have_uuids()
    {
        $role = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        $user = User::factory()->create();
        $user->assignRole($role);

        $this->assertTrue(\Illuminate\Support\Str::isUuid($user->id));
    }

    public function test_roles_are_seeded()
    {
        $this->seed();
        $this->assertDatabaseHas('roles', ['name' => 'super_admin']);
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'client']);
    }

    public function test_client_can_view_own_project()
    {
        $this->seed();

        $clientRole = Role::where('name', 'client')->first();
        $clientUser = User::factory()->create();
        $clientUser->assignRole($clientRole);
        $client = Client::create(['user_id' => $clientUser->id, 'company_name' => 'Test Co']);

        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'My Project',
            'status' => 'Active'
        ]);

        $this->actingAs($clientUser);

        $this->assertTrue($clientUser->can('view', $project));
    }

    public function test_client_cannot_view_other_project()
    {
        $this->seed();

        $clientRole = Role::where('name', 'client')->first();

        // Client A
        $userA = User::factory()->create();
        $userA->assignRole($clientRole);
        $clientA = Client::create(['user_id' => $userA->id, 'company_name' => 'Co A']);

        // Client B
        $userB = User::factory()->create();
        $userB->assignRole($clientRole);
        $clientB = Client::create(['user_id' => $userB->id, 'company_name' => 'Co B']);
        $projectB = Project::create([
            'client_id' => $clientB->id,
            'title' => 'Project B',
            'status' => 'Active'
        ]);

        $this->actingAs($userA);

        $this->assertFalse($userA->can('view', $projectB));
    }

    public function test_admin_can_view_any_project()
    {
        $this->seed();

        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::factory()->create();
        $adminUser->assignRole($adminRole);

        $clientRole = Role::where('name', 'client')->first();
        $clientUser = User::factory()->create();
        $clientUser->assignRole($clientRole);
        $client = Client::create(['user_id' => $clientUser->id, 'company_name' => 'Test Co']);

        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'My Project',
            'status' => 'Active'
        ]);

        $this->actingAs($adminUser);

        $this->assertTrue($adminUser->can('view', $project));
        $this->assertTrue($adminUser->can('viewAny', Project::class));
    }
}
