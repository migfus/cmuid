<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requesting extends Model
{
  use HasFactory;

  public $incrementing = false;

  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'claim_type_id',
    'status_category_id',
    'picture',
    'thumbnail',
    'last_name',
    'first_name',
    'mid_name',
    'ext_name',
    'position',
    'department',
    'unit',
    'email',
    'mobile',
  ];

  public function status() {
    return $this->hasMany(RegisterStatus::class, 'user_register_id');
  }

  public function files() {
    return $this->hasMany(File::class, 'user_register_id');
  }

  public function claim_type() {
    return $this->belongsTo(ClaimType::class);
  }

  public function status_category() {
    return $this->belongsTo(StatusCategory::class);
  }
}
