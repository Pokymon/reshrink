<?php

namespace App\Models;

use App\Notifications\CustomResetPassword;
use App\Notifications\CustomVerifyEmail;
use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  implements MustVerifyEmail
{
  use HasFactory, Notifiable, UuidTrait, SoftDeletes;

  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  protected $dates = [
    'deleted_at',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function links()
  {
    return $this->hasMany(Link::class);
  }

  public function sendEmailVerificationNotification()
  {
    $this->notify(new CustomVerifyEmail);
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new CustomResetPassword($token));
  }
}
