<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserRegister;
use App\Models\RegisterStatus;
use App\Models\TextMessage;


class UserRegisterController extends Controller
{
    // NOTE Show list on dashboard
  // [admin]
  public function index() {
      //
  }

  // NOTE Registration
  // [any]
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

    $picture = $this->G_FileUpload($req->picture);
    $csc_id = $this->generateRandomString();

    if(UserRegister::where('id', $csc_id)->exists()) {
      $this->store($req);
    }

    $id = UserRegister::create([
      'id' => $csc_id,
      'status_category_id' => 2,
      'claim_type_id' => $req->claim_type_id,
      'picture' => $picture,
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

    RegisterStatus::create([
      'user_register_id' => $id,
      'category_id' => 1,
      'content' => "New CSC ID Registered",
    ]);
    RegisterStatus::create([
      'user_register_id' => $id,
      'category_id' => 2,
    ]);

    TextMessage::create([
      'user_register_id' => $id,
      'content' => "Hello ".$this->G_Fullname($req->last_name, $req->first_name, $req->mid_name, $req->ext_name).",\nThank you for using the OHRM CSC-ID, we will notify you for any updates upon processing the request.\nFrom the OHRM CSC-ID System"
    ]);


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $id,
    ], 200);

  }

  // NOTE Detailed data
  // [any] -> csc_id
  public function show(UserRegistration $userRegistration) {
      //
  }

  // NOTE Update in dashboard
  // [admin]
  public function update(Request $request, UserRegistration $userRegistration) {
      //
  }

  // NOTE Delete record in dashboard
  // [admin]
  public function destroy(UserRegistration $userRegistration) {
      //
  }
}
