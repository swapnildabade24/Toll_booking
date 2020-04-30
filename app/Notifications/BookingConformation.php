<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use LaravelQRCode\Facades\QRCode;

class BookingConformation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->vehicle_number = $data[0];
        $this->source = $data[1];
        $this->destination = $data[2];
        $this->journey_date = $data[3];
        $this->cost = $data[4];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $pngImage = QrCode::format('png')->merge('ss.png', 0.3, true)
        //                 ->size(500)->errorCorrection('H')
        //                 ->generate('Welcome to kerneldev.com!');
        // $pngImage = QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
        // ->size(500)->generate('Welcome to Toll Booking');
        return (new MailMessage)
                    ->line('Your booking is confromed')
                    ->line('Vehicle Number: ' .$this->vehicle_number)
                    ->line('Source: ' .$this->source)
                    ->line('Destination: ' .$this->destination)
                    ->line('Journey Date: ' .$this->journey_date)
                    ->line('Total Price: '.$this->cost)
                    ->action('Go to Toll Booking', url('/'))
                    ->line('Thank you for using our Toll Booking!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
