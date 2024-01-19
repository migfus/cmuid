<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

use App\Models\RequestStatus;
use App\Models\Requesting;

class RequestStatusPublicController extends Controller
{
  public function show(Request $req, $id) {
    $status = RequestStatus::where('requesting_id', $id)
      ->with(['status_category', 'requesting', 'user'])
      ->orderBy('created_at', 'ASC')
      ->get();

    $info = Requesting::where('id', $id)->with('files')->first();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => ['status' => $status, 'info' => $info],
    ], 200);
  }
}
