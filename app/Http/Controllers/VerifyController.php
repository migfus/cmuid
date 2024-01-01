<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserRegister;

class VerifyController extends Controller
{
  public function show(Request $req, string $id) {
    $info = UserRegister::where('id', $id)
      ->with(['status'])
      ->whereHas('status', function($q) {
        $q->where('category_id', 5);
      })
      ->first();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $info,
    ], 200);
  }
}
