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

      $data = UserRegister::doesntHave('files')->get();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    // NOTE upload file and attach to user_register
    public function store(Request $request)
    {
        //
    }

    // NOTE Remove attachement from user_register
    public function destroy(File $file)
    {
        //
    }
}
