<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

use App\Models\UserRegister;

class VerifyPublicController extends Controller
{
  public function show(Request $req, string $id) {
    $info = UserRegister::where('id', $id)
      ->with(['status', 'files'])
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
