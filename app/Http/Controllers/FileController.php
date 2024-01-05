<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\File;
use App\Models\UserRegister;

class FileController extends Controller
{
    // NOTE mix-match user_register & file
    public function index(Request $req) {
      if(!$req->user()->can('feedback register')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'filter' => 'required'
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $data = null;
      switch($req->filter) {
        case 'uploaded':
          $data = UserRegister::where('claim_type_id', 2)->with('files')->has('files')->get();
          break;
        case
          $data = UserRegister::where('claim_type_id', 2)->doesntHave('files')->get();
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    // NOTE upload file and attach to user_register
    public function store(Request $req) {
      if(!$req->user()->can('feedback register')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'picture' => 'required|file|max:2042',
        'user_register_id' => 'required',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $picture = $this->G_FileUpload($req->picture);

      $data = File::create([
        'user_register_id' => $req->user_register_id,
        'name' => $req->user_register_id,
        'url' => $picture,
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true
      ]);
    }

    // NOTE Remove attachement from user_register
    public function destroy(Request $req, $id) {
      if(!$req->user()->can('feedback register')) {
        return $this->G_UnauthorizedResponse();
      }

      $data = File::where('id', $id)->delete();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data
      ]);
    }
}