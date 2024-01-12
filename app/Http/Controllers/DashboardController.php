<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserRegister;

class DashboardController extends Controller
{
  public function RequestNumber() {
    $data = [
      'requesting' => UserRegister::where('status_category_id', '>=', 3)->count(),
      'completed' => UserRegister::where('status_category_id', 5)->count(),
      'canceled' => UserRegister::where('status_category_id', 4)->count(),
      'claimed' => UserRegister::where('status_category_id', 6)->count(),
    ];

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data,
    ], 200);
  }
}
