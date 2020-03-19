<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessageController extends Controller
{
    public function index(request $request){

        $userId = auth()->id();
        $contactId = $request->contact_id;

        $messages = Message::select(
            'id',
            DB::raw("IF(`from_id` = $userId, TRUE, FALSE) as written_by_me"),
            'content',
            'created_at')
            ->where(function ($query) use ($userId, $contactId){
                $query->where('from_id', $userId)->where('to_id', $contactId);
            })->orWhere(function ($query) use ($userId, $contactId){
                $query->where('from_id', $contactId)->where('to_id', $userId);
            })
            ->get();

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
        $data['message'] = $message;
        return $data;
    }
}
