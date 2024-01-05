<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserRegister;
use App\Models\RegisterStatus;
use App\Models\TextMessage;
use App\Models\ClaimType;

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

      $data = [];

      switch($req->filter) {
        case 'completed':
          $data = UserRegister::
            where('status_category_id', 5)
            ->with('claim_type')
            ->orderBy('created_at', $req->sort)
            ->get();
          break;
        case 'canceled':
          $data = UserRegister::
            where('status_category_id', 4)
            ->with('claim_type')
            ->orderBy('created_at', $req->sort)
            ->get();
          break;
        case 'claimed':
          $data = UserRegister::
            where('status_category_id', 6)
            ->with('claim_type')
            ->orderBy('created_at', $req->sort)
            ->get();
          break;
        default:
          $data = UserRegister::
            where('status_category_id', '<>', 5)->where('status_category_id', '<>', 4)
            ->with('claim_type')
            ->orderBy('created_at', $req->sort)
            ->get();
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //
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
