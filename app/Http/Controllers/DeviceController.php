<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Models\Device;

class DeviceController extends Controller
{
    // NOTE list of devices [web]
    public function index(Request $req) {
      if(!$req->user()->can('index register')) {
        return $this->G_UnauthorizedResponse();
      }

      $data = Device::
        orderBy('created_at', 'DESC')
        ->get();

      // dd($data);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    // NOTE New device will be added [web]
    public function store(Request $req) {
      if(!$req->user()->can('index register')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'qr' => 'required'
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $id = Device::create([
        'id' => $req->qr['id'],
        'last_response' => Carbon::now()->subYears(999),
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true,
      ], 200);

    }

    // NOTE Connect to device and update [device]
    public function update(Request $req, string $id) {
      $val = Validator::make($req->all(), [
        'name' => 'required',
        'platform' => 'required'
      ]);

      $data = Device::where('id', $id)->update([
        'name' => $req->name,
        'platform' => $req->platform,
        'last_response' => Carbon::now('UTC'),
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data ? true : false,
      ], 200);
    }

    // NOTE Remove device [web]
    public function destroy(string $id) {
      $id = Device::where('id', $id)->delete();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true
      ], 200);
    }
}
