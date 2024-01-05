<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RegisterStatus;
use App\Models\UserRegister;

class RegisterStatusController extends Controller
{
  public function show(Request $req, $id) {
    $status = RegisterStatus::where('user_register_id', $id)
      ->with(['category', 'user_register', 'user'])
      ->orderBy('created_at', 'ASC')
      ->get();

    $info = UserRegister::where('id', $id)->with('files')->first();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => ['status' => $status, 'info' => $info],
    ], 200);
  }
}
