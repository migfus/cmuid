<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserRegister;
use App\Models\RegisterStatus;
use App\Models\TextMessage;
use App\Models\ClaimType;
use App\Models\StatusCategory;

class RequestController extends Controller
{
  // NOTE List of ID Request
  public function index(Request $req) {
    if(!$req->user()->can('index register')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'search' => '',
      'sort' => 'required',
      'filter' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $data = UserRegister::where(function ($q) use($req) {
      $q->whereRaw("CONCAT(`last_name`, ', ', `first_name`) LIKE ?", ['%'.$req->search.'%'])
        ->orWhere('email', 'LIKE', '%'.$req->search.'%')
        ->orWhere('department', 'LIKE', '%'.$req->search.'%')
        ->orWhere('unit', 'LIKE', '%'.$req->search.'%')
        ->orWhere('mobile', 'LIKE', '%'.$req->search.'%');
    });

    switch($req->filter) {
      case 'canceled':
        $data->where('status_category_id', 4);
        break;
      case 'completed':
        $data->where('status_category_id', 5);
        break;
      case 'claimed':
        $data->where('status_category_id', 6);
        break;
      default:
        $data->where('status_category_id', '<', 4);
    }


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data
        ->orderBy('created_at', $req->sort)
        ->with(['claim_type', 'status_category'])
        ->paginate(10),
    ], 200);
  }

  // NOTE Cancel/Mark Done queries
  public function update(Request $req, string $id) {
    if(!$req->user()->can('feedback register')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'form' => 'required',
      'content' => 'required',
      'sms' => '',
      'sendSMS' => '',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    if($req->sendSMS) {
      $this->SendSMS($req, $id);
    }

    switch($req->form) {
      case 'complete':
        $this->Complete($req, $id, $req->user()->id, 'Done');
        break;
      case 'cancel':
        $this->Cancel($req, $id, $req->user()->id, 'Cancelled');
        break;
      case 'claim':
        $this->Claim($req, $id, $req->user()->id, 'Claimed');
        break;
      default: //NOTE Feedback
        $this->Feedback($req, $id, $req->user()->id);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

    private function SendSMS(Request $req, $id) {
      TextMessage::create([
        'user_register_id' => $id,
        'content' => $req->sms,
      ]);

      return true;
    }

    private function Complete(Request $req, string $id, string $user_id) : void {
      UserRegister::where('id', $id)
      ->update([
        'status_category_id' => 5 // NOTE Done
      ]);

      RegisterStatus::create([
        'user_register_id' => $id,
        'user_id' => $user_id,
        'category_id' => 5,
        'content' => $req->content,
      ]);
    }

    private function Cancel(Request $req, string $id, string $user_id) : void {
      UserRegister::where('id', $id)->update([
        'status_category_id' => 4 // NOTE Done
      ]);

      RegisterStatus::create([
        'user_register_id' => $id,
        'user_id' => $user_id,
        'category_id' => 4,
        'content' => $req->content,
      ]);
    }

    private function Feedback(Request $req, string $id, string $user_id) : void {
      RegisterStatus::create([
        'user_register_id' => $id,
        'user_id' => $user_id,
        'category_id' => 3,
        'content' => $req->content,
      ]);
    }

    private function Claim(Request $req, string $id, string $user_id) : void {
      UserRegister::where('id', $id)->update([
        'status_category_id' => 6 // NOTE Claimed
      ]);

      RegisterStatus::create([
        'user_register_id' => $id,
        'user_id' => $user_id,
        'category_id' => 6,
        'content' => $req->content,
      ]);
    }
}
