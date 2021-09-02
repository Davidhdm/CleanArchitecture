<?php

namespace Tests\Feature\UseCases\Subscriptions;

use App\Models\User;
use App\Models\Workshop;
use App\UseCases\Subscriptions\UnsubscribeUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnsubscribeUseCaseTest extends TestCase
{
  use RefreshDatabase;
  /**
   *
   *
   * @return void
   */
  public function test_user_can_unsubscribe_from_workshop()
  {
    $user = User::factory()->create();
    $workshop = Workshop::factory()->create();

    $user->subscriptions()->attach($workshop);

    $unsubscribeService = new UnsubscribeUseCase();
    $unsubscribeService->execute($user->id, $workshop->id);

    $this->assertEquals(0, $user->subscriptions->count());
  }
}
