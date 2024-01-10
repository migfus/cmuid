<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;
use Intervention\Image\ImageManager;

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

  public function G_FileUploadImage($file, $target_dir = 'uploads/') {
    // NOTE UPLOAD ORIGINAL
    $image = time().'.'.$file->extension();
    $file->move(public_path($target_dir), $image);
    $original = '/'.$target_dir.$image;

    $thumbnail = $this->thumbnail(200, '/uploads/thumbnails/'.$image, public_path($original));

    // dd(public_path($original));

    return ['original' => $original, 'thumbnail' => $thumbnail];
  }

    private function thumbnail($newWidth = 200, $targetFile = '', $original) {
      $info = getimagesize($original);
      $mime = $info['mime'];

      switch ($mime) {
        case 'image/jpeg':
          $image_create_func = 'imagecreatefromjpeg';
          $image_save_func = 'imagejpeg';
          $new_image_ext = 'jpg';
          break;

        case 'image/png':
          $image_create_func = 'imagecreatefrompng';
          $image_save_func = 'imagepng';
          $new_image_ext = 'png';
          break;

        case 'image/gif':
          $image_create_func = 'imagecreatefromgif';
          $image_save_func = 'imagegif';
          $new_image_ext = 'gif';
          break;

        default:
          throw new Exception('Unknown image type.');
      }

      $img = $image_create_func($original);
      list($width, $height) = getimagesize($original);

      $newHeight = ($height / $width) * $newWidth;
      $tmp = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); // swapped w -> h

      $image_save_func($tmp, public_path($targetFile));

      return $targetFile;
    }

    private function png_thumbnail($original, $image) : void {
      $_original = imagecreatefrompng(public_path($original));

      $original_w = imagesx($_original);
      $original_h = imagesx($_original);

      $resizedW = 200;
      $resizedH = round($original_h * ($resizedW/$original_w));

      $resized = imagecreatetruecolor($resizedW, $resizedH);
      imagecopyresampled($resized, $_original, 0, 0, 0, 0, $resizedW, $resizedH, $original_w, $original_w);
      imagepng($resized, public_path('/uploads/thumbnails/'.$image));
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
