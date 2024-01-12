<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;

class DownloadController extends Controller
{
  public function show(Request $req, $id) {
    $data = File::findOrFail($id);

    return response()->download($data['url']);
  }
}
