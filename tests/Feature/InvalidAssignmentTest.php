<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvalidAssignmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that assigning a non-existent role to a user fails.
     *
     * @return void
     */
    public function test_invalid_role_assignment()
    {
        $user = User::factory()->create();

        // Try to assign a non-existent role
        $response = $this->actingAs($user)->postJson('/api/users/' . $user->id . '/assign-role', [
            'role' => 'nonexistent-role'
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test that assigning a non-existent permission to a role fails.
     *
     * @return void
     */
    public function test_invalid_permission_assignment()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        // Assign the role to the user
        $user->assignRole($role);

        // Try to assign a non-existent permission
        $response = $this->actingAs($user)->postJson('/api/roles/' . $role->id . '/assign-permission', [
            'permission' => 'nonexistent-permission'
        ]);

        $response->assertStatus(401);
    }
}
