<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionAssignmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that permissions can be assigned to a role.
     *
     * @return void
     */
    public function test_permission_can_be_assigned_to_role()
    {
        // Create a role and permission
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit posts']);

        // Assign permission to the role
        $role->givePermissionTo($permission);

        // Assert that the role has the permission
        $this->assertTrue($role->hasPermissionTo('edit posts'));
    }

    /**
     * Test that permissions can be removed from a role.
     *
     * @return void
     */
    public function test_permission_can_be_removed_from_role()
    {
        // Create a role and permission
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit posts']);

        // Assign permission to the role
        $role->givePermissionTo($permission);

        // Remove permission from the role
        $role->revokePermissionTo($permission);

        // Assert that the role no longer has the permission
        $this->assertFalse($role->hasPermissionTo('edit posts'));
    }
}
