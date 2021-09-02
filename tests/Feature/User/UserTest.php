<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_user_is_not_admin()
  {
    $user = User::factory()->create();
    $this->assertFalse($user->isAdmin());
  }

  public function test_user_is_admin()
  {
    $user = User::factory()->create(['is_admin' => true]);
    $this->assertTrue($user->isAdmin());
  }
}
