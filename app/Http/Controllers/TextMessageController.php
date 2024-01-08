<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\TextMessage;
use App\Models\Device;

class TextMessageController extends Controller
{
  // NOTE List of Text [pending, done][device]
  public function index(Request $req) {
    $val = Validator::make($req->all(), [
      'id' => 'required',
      'type' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $device = Device::where('id', $req->id)->first();

    Device::where('id', $req->id)->update([
      'last_response' => Carbon::now('UTC'),
    ]);

    $data = [];

    if($device) {
      switch($req->type) {
        case 'pending':
          $data = TextMessage::whereNull('read_at')
            ->with('user_register')
            ->orderBy('created_at', 'ASC')
            ->get();
          break;
        default:
          $data = TextMessage::whereNotNull('read_at')
            ->with('user_register')
            ->orderBy('created_at', 'DESC')
            ->limit(20)
            ->get();
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => false,
    ], 401);
  }


  // NOTE Mark read_at assume that it had already sent.
  public function update(Request $req, $id) {
    $val = Validator::make($req->all(), [
      'device_id' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $device = Device::where('id', $req->device_id)->first();
    Device::where('id', $req->device_id)->update([
      'last_response' => Carbon::now('UTC'),
    ]);

    if($device) {
      TextMessage::where('id', $id)->update([
        'device_id' => $req->device_id,
        'read_at' => Carbon::now('UTC'),
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => false,
    ], 401);
  }
}
