<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAssignmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can be assigned a role.
     *
     * @return void
     */
    public function test_user_can_be_assigned_role()
    {
        // Create a user and a role
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        // Assign the role to the user
        $user->assignRole($role);

        // Assert that the user has the assigned role
        $this->assertTrue($user->hasRole('admin'));
    }

    /**
     * Test that a user can have roles removed.
     *
     * @return void
     */
    public function test_user_can_have_role_removed()
    {
        // Create a user and assign a role
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);

        // Remove the role
        $user->removeRole($role);

        // Assert that the user no longer has the role
        $this->assertFalse($user->hasRole('admin'));
    }
}
