<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{
  use HasFactory;

  protected $fillable = [
    'device_id',
    'user_register_id',
    'content',
    'read_at'
  ];

  public function user_register() {
    return $this->belongsTo(UserRegister::class, 'user_register_id');
  }
}
