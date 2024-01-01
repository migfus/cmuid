<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterStatus extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_register_id',
      'user_id',
      'category_id',
      'content'
    ];

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
