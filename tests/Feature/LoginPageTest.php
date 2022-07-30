<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginPageTest extends TestCase
{
   public function test_user_can_login_using_the_login_form()
   {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();

        $response->assertRedirect('/');
   }

   public function test_user_can_not_access_admin_page()
   {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
       $this->get('/admin/users');

        $response->assertRedirect('/');
   }

   public function test_user_can_access_admin_page()
   {
        // Define new User
        $user = User::factory()->create();

        //attach admin role
        $user->roles()->attach(1);

        //Login
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        //access Users page
       $response = $this->get('/admin/users');

       //Check text Users to verify User page wass accessed
        $response->assertSeeText('User');
   }
}
