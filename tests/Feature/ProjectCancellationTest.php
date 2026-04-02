<?php

namespace Tests\Feature;

use App\Actions\CancelProjectAction;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCancellationTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cancellation_forfeits_25_percent()
    {
        $this->seed();

        $user = User::factory()->create(['role_id' => Role::where('name', 'Client')->first()->id]);
        $client = Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);
        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'Test Project',
            'budget' => 10000,
            'status' => 'Active',
        ]);

        $action = new CancelProjectAction();
        $cancelledProject = $action->execute($project, 'client');

        $this->assertEquals('Cancelled', $cancelledProject->status);
        $this->assertEquals('client', $cancelledProject->cancelled_by);
        $this->assertEquals(2500, $cancelledProject->forfeit_amount); // 25% of 10000
        $this->assertNotNull($cancelledProject->cancellation_date);

        $this->assertDatabaseHas('expenses', [
            'amount' => 2500,
            'category' => 'Project Cancellation Forfeit',
        ]);
    }

    public function test_admin_cancellation_full_refund()
    {
        $this->seed();

        $user = User::factory()->create(['role_id' => Role::where('name', 'Client')->first()->id]);
        $client = Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);
        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'Test Project',
            'budget' => 10000,
            'status' => 'Active',
        ]);

        $action = new CancelProjectAction();
        $cancelledProject = $action->execute($project, 'admin');

        $this->assertEquals('Cancelled', $cancelledProject->status);
        $this->assertEquals('admin', $cancelledProject->cancelled_by);
        $this->assertEquals(0, $cancelledProject->forfeit_amount); // Full refund
        $this->assertNotNull($cancelledProject->cancellation_date);

        // No expense should be created for admin cancellation
        $this->assertDatabaseMissing('expenses', [
            'category' => 'Project Cancellation Forfeit',
        ]);
    }
}
