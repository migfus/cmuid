<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Models\UserRegister;

class StatisticDashboardController extends Controller
{
  public function RequestNumber(Request $req) {
    if(!$req->user()->can('feedback register')) {
      return $this->G_UnauthorizedResponse();
    }

    $data = [
      'requesting' => UserRegister::where('status_category_id', '<=', 3)->count(),
      'completed' => UserRegister::where('status_category_id', 5)->count(),
      'canceled' => UserRegister::where('status_category_id', 4)->count(),
      'claimed' => UserRegister::where('status_category_id', 6)->count(),
      'upload' => UserRegister::where('claim_type_id', 2)->doesntHave('files')->count()
    ];

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data,
    ], 200);
  }
}
