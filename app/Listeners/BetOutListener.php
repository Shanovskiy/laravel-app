<?php

namespace App\Listeners;

use App\Events\BetOutEvent;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BetOutListener
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
     * @param object $event
     * @return void
     */
    public function handle(BetOutEvent $event)
    {
        $user = User::query()->find($event->getAuctionCar()->user_id);
        $car = Car::query()->find($event->getAuctionCar()->car_id);
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'body' => 'Ваша ставка перебита '.$car->brand." ".$car->model
        ];

        Mail::send('emails.bet-out', $data, function($message) use ($data) {
            $message->to($data['email'])->subject('Ваша ставка перебита');
            $message->from('viktor6998@list.ru');
        });
    }
}
