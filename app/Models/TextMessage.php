<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TextMessage extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'device_id',
    'requesting_id',
    'content',
    'read_at'
  ];

  public function user_register() {
    return $this->belongsTo(UserRegister::class, 'user_register_id');
  }
}
