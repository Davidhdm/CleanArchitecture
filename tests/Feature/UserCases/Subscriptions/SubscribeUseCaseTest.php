<?php

namespace Tests\Feature\UserCases\Subscriptions;

use App\Models\User;
use App\Models\Workshop;
use App\UseCases\Subscriptions\SubscribeUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscribeUseCaseTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_user_can_subscribe_in_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals($user->subscriptions->count(), 1);
  }

  public function test_subscribed_user_cant_subscribe_in_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals($user->subscriptions->count(), 1);
  }

  public function test_admin_cant_subscribe_in_workshop()
  {
    $user = User::factory()->create(['is_admin' => true]);
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals($user->subscriptions->count(), 0);
  }

  public function test_user_can_unsubscribe_from_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    /* $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id); */
  }
}
