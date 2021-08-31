<?php

namespace App\Http\Controllers;

use App\UseCases\Subscriptions\SubscribeUseCase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function subscribe($request)
    {
      $subscribeService = new SubscribeUseCase();
      $subscribeService->execute(Auth::id(), $request->id);
    }
}
