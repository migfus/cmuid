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

  public $incrementing = false;

  public function status_category() {
    return $this->belongsTo(StatusCategory::class);
  }

  public function requesting() {
    return $this->belongsTo(Requesting::class);
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
}
