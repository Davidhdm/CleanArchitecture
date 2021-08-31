<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function subscriptions()
  {
    return $this->belongsToMany(Workshop::class, 'subscriptions', 'subscriber_id', 'workshop_id');
  }

  public function isSubscribed($workshopId)
  {
    if ($this->subscriptions()->find($workshopId)) {
      return true;
    };

    return false;
  }

  public function isAdmin()
  {
    if ($this->is_admin) {
      return true;
    }

    return false;
  }
}
