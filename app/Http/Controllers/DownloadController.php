<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;
use App\Models\UserRegister;
use App\Models\StatusCategory;
use App\Models\TextMessage;

class DownloadController extends Controller
{
  public function show(Request $req, $id) {
    $data = File::findOrFail($id);

    if($data) {
      $register = UserRegister::
        where('id', $data->user_register_id)
        ->where('status_category_id', '<>', StatusCategory::where('name', 'claimed')->first()->id)
        ->update([
          'status_category_id' => StatusCategory::where('name', 'claimed')->first()->id
        ]);

      // NOTE prevent spam
      if($register) {
        TextMessage::create([
          'user_register_id' => $data->user_register_id,
          'content' => 'You successfully received the CSC-ID Soft-Copy.',
        ]);
      }


    }

    return redirect()->to(url($data->url));
  }
}
