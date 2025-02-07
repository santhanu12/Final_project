<?php

use App\Models\User;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BasicTest extends TestCase{
use RefreshDatabase;

public function test_basic_test(): void
    {
        $this->assertTrue(true);
    }       

public function test_can_create_a_user()
{

    User::factory()->create([
        'name' => 'Adrian',
        'email' => 'johndo@example.com',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'johndo@example.com',
    ]);
}

public function test_add_user()
{

    $data = [
        'id' => 2,
        'name' => 'shrinath',
        'email' => 'updad@example.com',
        'admin_id'=>1,
        'role'=>'manager',
        'password' => 'Santhanu@2001',
        'password_confirmation' => 'Santhanu@2001',
    ];

    // Act: Send POST request to update user details
    $response = $this->post('/add-user', $data);
   
    $response->assertStatus(200);
    // Assert: Check if the user is updated in the database
   $this->assertDatabaseHas('users', [
        'id' => 2,
        'name' => 'shrinath',
        'email' => 'updad@example.com',
    ]);

    // Assert: Check if it redirects to the correct view (dashboard)
    $response->assertViewIs('admin.manage-user');
}

public function test_returns_only_manager_names()
{
    // Create managers
    $manager1 = User::factory()->create(['name' => 'Alice', 'role' => 'manager']);
    $manager2 = User::factory()->create(['name' => 'Bob', 'role' => 'manager']);

    // Create non-managers
    $user1 = User::factory()->create(['name' => 'Charlie', 'role' => 'employee']);
    $user2 = User::factory()->create(['name' => 'David', 'role' => 'admin']);

    // Make request to the endpoint
    $response = $this->post('admingetmanagername');

    // Assert response format
    $response->assertStatus(200)
             ->assertJson([
                 ['name' => 'Alice'],
                 ['name' => 'Bob']
             ]);

    // Ensure non-managers are not included
    $response->assertJsonMissing([['name' => 'Charlie']]);
    $response->assertJsonMissing([['name' => 'David']]);
}

public function test_home_page_returns_view()
    {
        
        $response = $this->get('/');

        $response->assertStatus(200);


        $response->assertViewIs('auth.login');
    }


    public function test_register_page_returns_view()
    {
        
        $response = $this->get('/register');

        
        $response->assertStatus(200);

       
        $response->assertViewIs('auth.register');
    }

    public function test_manage_task_page_returns_view()
    {
        
        $response = $this->get('/manage-task');

        
        $response->assertStatus(200);

       
        $response->assertViewIs('admin.manage-task');
    }

    public function test_user_task_page_returns_view()
    {
        // Make a GET request to the route
        $response = $this->get('/userTask');

        // Assert that the response is OK (HTTP 200)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('userTask');
    }

    public function test_user_store_successfully()
    {
        // Simulate a valid request
        $response = $this->post('/add-user', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role' => 'user',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'manager' => null,
            'admin_id' => 1,
        ]);

        // Assert the user is in the database
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role' => 'user',
        ]);

        // Assert status is successful (200)
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_users_page()
    {
        $user = User::factory()->create(); // Create a test user

        $response = $this->actingAs($user)->get('dashboard'); // Authenticate the user

        $response->assertStatus(200); // Should now pass
    }

    public function test_updates_user_details_successfully()
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'password' => Hash::make('oldpassword'),
        ]);

        $response = $this->post('edit-user', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'newss@example.com',
            'password' => 'newpassword',
        ]);

        
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'newss@example.com',
        ]);

        // Assert password is hashed
        $updatedUser = User::find($user->id);
        $this->assertTrue(Hash::check('newpassword', $updatedUser->password));

        // Ensure response is correct
        $response->assertViewIs('admin.manage-user');
    }

    public function test_redirects_admin_to_manage_user_page_on_successful_login()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect('manage-user');
    }

    public function test_deletes_a_task_successfully()
    {
        $task = Task::factory()->create();

        $response = $this->post('deletetaskDetails', ['id' => $task->id]);

        // Assert the task is deleted
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);

        // Assert response message
        $response->assertStatus(200)
                 ->assertSee('User Deleted Successfully');
    }
}




