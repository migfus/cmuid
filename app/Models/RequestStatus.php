<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RequestStatus extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'requesting_id',
    'user_id',
    'status_category_id',
    'content'
  ];

  protected $incrementing = false;

  public function category() {
    return $this->belongsTo(StatusCategory::class);
  }

  public function user_register() {
    return $this->belongsTo(UserRegister::class);
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
}
