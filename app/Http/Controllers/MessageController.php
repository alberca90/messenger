<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessageController extends Controller
{
    public function index(){

        $userId = auth()->id();
        $messages = Message::select(
            'id',
            DB::raw("IF(`from_id` = $userId, TRUE, FALSE) as written_by_me"),
            'content',
            'created_at')->get();

        return $messages;
    }

    public function store(request $request)
    {
        $message = new Message;
        $message->from_id = auth()->id();
        $message->to_id = $request->to_id;
        $message->content = $request->content;
        $saved = $message->save();

        $data = [];
        $data['succes'] = $saved;
        return $data;
    }
}
