<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function store(Request $request)
    {
        $senderName = $request->user() ? $request->user()->name : 'Guest';
        broadcast(new ChatMessageReceived($senderName, $request->message))->toOthers();
    }
}
