<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

use App\Models\ClaimType;

class ClaimTypePublicController extends Controller
{
  // NOTE list of claim types on request/confirm
  public function index() {
    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => ClaimType::get(),
    ], 200);
  }
}
