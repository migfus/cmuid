<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Models\Requesting;

class StatisticDashboardController extends Controller
{
  public function RequestNumber(Request $req) {
    if(!$req->user()->can('feedback register')) {
      return $this->G_UnauthorizedResponse();
    }

    $data = [
      'requesting' => Requesting::where('status_category_id', '<=', 3)->count(),
      'completed' => Requesting::where('status_category_id', 5)->count(),
      'canceled' => Requesting::where('status_category_id', 4)->count(),
      'claimed' => Requesting::where('status_category_id', 6)->count(),
      'upload' => Requesting::where('claim_type_id', 2)->doesntHave('files')->count()
    ];

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data,
    ], 200);
  }
}
