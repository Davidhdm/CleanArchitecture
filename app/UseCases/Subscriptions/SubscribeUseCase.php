<?php

namespace App\UseCases\Subscriptions;

use App\Models\User;
use App\Models\Workshop;

class SubscribeUseCase
{
  public function execute($userId, $workshopId)
  {
    $user = User::find($userId);
    $workshop = Workshop::find($workshopId);

    if (!$user->isSubscribed($workshopId) && !$user->isAdmin()) {
      $user->subscriptions()->attach($workshop);
    }
  }
}
