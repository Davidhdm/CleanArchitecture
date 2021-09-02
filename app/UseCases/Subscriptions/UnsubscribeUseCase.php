<?php

namespace App\UseCases\Subscriptions;

use App\Models\User;
use App\Models\Workshop;

class UnsubscribeUseCase
{
  public function execute($userId, $workshopId)
  {
    $user = User::findOrFail($userId);
    $workshop = Workshop::findOrFail($workshopId);

    if ($user->isSubscribed($workshopId) && !$user->isAdmin()) {
      $user->subscriptions()->detach($workshop);
    }
  }
}