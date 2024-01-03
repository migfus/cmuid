<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TextMessage;
use App\Models\Device;

class TextMessageController extends Controller
{
  // NOTE List of Text [pending, done]
  public function index(Request $req) {
    $device = Device::findOrFail($req->id)->first();

    if($device) {
      $data = TextMessage::whereNull('read_at')->get();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $data,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TextMessage $textMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TextMessage $textMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TextMessage $textMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TextMessage $textMessage)
    {
        //
    }
}
