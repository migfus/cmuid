<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
      'id',
      'status_category_id',
      'picture',
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
}
