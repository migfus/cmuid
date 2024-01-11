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

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function info() {
    return $this->hasOne(Info::class);
  }
}
