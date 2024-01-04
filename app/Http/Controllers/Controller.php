<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;

use App\Models\User;

class Controller extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  public function G_ReturnDefault($req = null) : array {
    if($req) {
      $auth = User::where('id', $req->user()->id)->with('person')->first();

      return [
        'status' => true,
        'message' => 'success',
        'auth' => [
          'ip' => $_SERVER['REMOTE_ADDR'],
          'auth' => $auth,
          // 'token'=> $auth->createToken('token idk wv')->plainTextToken,
          'permissions' => $auth->getAllPermissions()->pluck('name'),
        ]
      ];
    }
    else {
      return [
        'status' => true,
        'message' => 'success',
      ];
    }

  }

  public function G_UnauthorizedResponse($message = 'Logout') : JsonResponse {
    return response()->json([
      'status' => false,
      'message' => $message]
      , 401);
  }

  public function G_ValidatorFailResponse($val) : JsonResponse {
    return response()->json([
      'status' => false,
      'message' => 'Invalid Input',
      'errors' => $val->errors()
    ], 401);
  }

  public function G_AvatarUpload($image, $path = '') {
    list($type, $image) = explode(';', $image);
    list(, $image) = explode(',', $image);

    $image = base64_decode($image);
    $imageName = time(). '.jpg';
    $location = '/uploads/'.$path.$imageName;
    file_put_contents('uploads/'.$path.$imageName, $image);

    return url('').$location;
  }

  public function G_FileUpload($file) : string {

    $target_dir = "uploads/";
    $image = time().'.'.$file->extension();
    $file->move(public_path($target_dir), $image);

    return '/'.$target_dir.$image;
  }

  public function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function G_Fullname($l, $f, $m, $e) {
    if($m != null && $e != null) {
      return $l.", ".$f." ".$m.". ".$e.".";
    }
    else if ($m != null ) {
      return $l.", ".$f." ".$m;
    }
    return $l.", ".$f;
  }
}
