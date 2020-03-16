<?php

namespace App\Observers;

use App\Message;
use App\Conversation;
use App\Events\MessageSend;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {

        // Esta es la parte del que envia el mensaje
       $conversation = Conversation::with('contact:id,name')->where('user_id', $message->from_id)->where('contact_id', $message->to_id)->first();

       if($conversation){
        $conversation->last_message = "Tú: $message->content";
        $conversation->last_time = $message->created_at;
        $conversation->save();
       }

        // Esta es la parte del que recibe el mensaje
       $conversation = Conversation::with('contact:id,name')->where('contact_id', $message->from_id)->where('user_id', $message->to_id)->first();

       if($conversation){
        $conversation->last_message = $conversation->contact->name.": ".$message->content;
        $conversation->last_time = $message->created_at;
        $conversation->save();
       }

       //Aquí vamos a usar Pusher para la comunicación en tiempo real, tenemos un evento llamado MessageSend, que vamos a utilizar para tal fín
       event(new MessageSend($message));
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
