<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Models\Device;

class DeviceController extends Controller
{
    // NOTE list of devices
    public function index(Request $req) {
      if(!$req->user()->can('index register')) {
        return $this->G_UnauthorizedResponse();
      }

      $data = Device::
        orderBy('created_at', 'DESC')
        ->get();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    // NOTE Device will be added upon scanning
    public function store(Request $req) {
      $val = Validator::make($req->all(), [
        'id' => 'required',
        'name' => 'required',
        'platform' => 'required'
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $id = Device::create([
        'id' => $req->id,
        'name' => $req->name,
        'platform' => $req->platform,
        'last_response' => Carbon::now()
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $req->id,
      ], 200);

    }

    // NOTE Connect to device
    public function show(Request $req, string $id) {
      $data = Device::findOrFail($id)->first();

      if($data) {
        Device::where('id', $id)->update([
          'name' => $req->name,
          'platform' => $req->platform,
          'last_response' => Carbon::now('UTC'),
        ]);
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true,
      ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
      $id = Device::where('id', $id)->delete();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $id ? true : false,
      ], $id ? 200 : 500);
    }
}
