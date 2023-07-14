<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index() {
        $messages = Message::all()->toArray();
        return response()->json(compact('messages'));
    }


    public function store(StoreMessageRequest $request) {
        $data = $request->validated();

        $message = Message::create($data);

        broadcast(new MessageSent($message))->toOthers();


        return response()->json(compact('message'));
    }
}
