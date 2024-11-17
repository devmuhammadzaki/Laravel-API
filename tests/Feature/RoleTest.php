<?php

// tests/Feature/RoleTest.php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user with the admin role can access the admin route.
     *
     * @return void
     */
    public function test_role_based_access()
    {
        // Create a user and an 'admin' role
        $user = User::factory()->create();
        $adminRole = Role::create(['name' => 'admin']);

        // Assign the 'admin' role to the user
        $user->assignRole($adminRole);

        // Try to access the /admin route
        $response = $this->actingAs($user)->get('/api/admin');

        // Assert that the response status is 200 (successful access)
        $response->assertStatus(200); // Can access the route
    }

    /**
     * Test that a user without the admin role cannot access the admin route.
     *
     * @return void
     */
    public function test_role_based_access_denied()
    {
        // Create a user without any roles
        $user = User::factory()->create();

        // Try to access the /admin route
        $response = $this->actingAs($user)->get('/api/admin');

        // Assert that the response status is 403 (forbidden)
        $response->assertStatus(403); // Access denied
    }
}
