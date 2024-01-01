<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Kra8\Snowflake\HasShortflakePrimary;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, HasShortflakePrimary;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'person_id',
    'avatar',
    'email_verified_at',
    'remember_token',

    'notify_email_job',
    'notify_email_news',
    'notify_email_event',

    'notify_sms_job',
    'notify_sms_news',
    'notify_sms_event',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
      'password',
      'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function info() {
    return $this->hasOne(Info::class);
  }


}
