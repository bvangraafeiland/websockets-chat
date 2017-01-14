<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function store(Request $request)
    {
        broadcast(new ChatMessageReceived($request->message))->toOthers();
    }
}
