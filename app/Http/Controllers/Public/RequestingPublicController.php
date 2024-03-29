<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Requesting;
use App\Models\RequestStatus;
use App\Models\TextMessage;


class RequestingPublicController extends Controller
{
  // NOTE Registration
  public function store(Request $req) {
    $val = Validator::make($req->all(), [
      'picture'   => 'required|file|max:5242',
      'last_name' => 'required',
      'first_name'=> 'required',
      'mid_name'  => '',
      'ext_name'  => '',
      'position'  => 'required',
      'department'=> '',
      'unit'   => '',
      'email'  => '',
      'mobile' => 'required',
      'claim_type_id' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $image_uploaded = $this->G_FileUploadImage($req->picture);
    $csc_id = $this->generateRandomString();

    if(Requesting::where('id', $csc_id)->exists()) {
      $this->store($req);
    }

    $id = Requesting::create([
      'id' => $csc_id,
      'status_category_id' => env('DB_STATUS_CATEGORY_PENDING', 'n.a'),
      'claim_type_id' => $req->claim_type_id,
      'picture' => $image_uploaded['original'],
      'thumbnail'  => $image_uploaded['thumbnail'],
      'last_name'  => $req->last_name,
      'first_name' => $req->first_name,
      'mid_name' => $req->mid_name ? strtoupper(str_replace('.', '', $req->mid_name)) : null,
      'ext_name' => $req->ext_name ? str_replace('.', '', $req->ext_name) : null,
      'position' => $req->position ?? null,
      'department' => $req->department ?? null,
      'unit'   => $req->unit,
      'email'  => $req->email ?? null,
      'mobile' => str_replace("-", "", $req->mobile),
    ])->id;

    RequestStatus::create([
      'requesting_id' => $id,
      'status_category_id' => env('DB_STATUS_CATEGORY_POST', 'n.a'),
      'content' => "New CSC ID Registered",
    ]);
    RequestStatus::create([
      'requesting_id' => $id,
      'status_category_id' => env('DB_STATUS_CATEGORY_PENDING', 'n.a'),
    ]);

    TextMessage::create([
      'requesting_id' => $id,
      'content' => "Hello ".$this->G_Fullname($req->last_name, $req->first_name, $req->mid_name, $req->ext_name).",\nThank you for using the OHRM CSC-ID, we will notify you for any updates upon processing the request.\nFrom the OHRM CSC-ID System"
    ]);


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $id,
    ], 200);

  }
}
