<?php

namespace Tests\Feature\UseCases\Subscriptions;

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
   *
   *
   * @return void
   */
  public function test_user_can_subscribe_in_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals(1, $user->subscriptions->count());
  }

  public function test_subscribed_user_cant_subscribe_in_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals(1, $user->subscriptions->count());
  }

  public function test_admin_cant_subscribe_in_workshop()
  {
    $user = User::factory()->create(['is_admin' => true]);
    $workshop = Workshop::factory()->create();

    $subscribeService = new SubscribeUseCase();
    $subscribeService->execute($user->id, $workshop->id);

    $this->assertEquals(0, $user->subscriptions->count());
  }
}
