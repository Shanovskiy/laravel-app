<?php

namespace App\Listeners;

use App\Events\OrderCarEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderActionsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCarEvent $event)
    {
        $data = [
            'name' => $event->order->user->name,
            'email' => $event->order->user->email,
            'body' => 'Спасибо за покупку '.$event->order->car->brand." ".$event->order->car->model
        ];

        Mail::send('emails.congratulation-order-car', $data, function($message) use ($data) {
            $message->to($data['email'])->subject('Спасибо за покупку');
            $message->from('viktor6998@list.ru');
        });
    }
}
