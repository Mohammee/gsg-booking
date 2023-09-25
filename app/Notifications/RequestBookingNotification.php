<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestBookingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Booking $booking)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $body = $this->booking->status == 'denied' ? __('Unfortunately, Your booking request is rejected.')
            : __('Congratulation, Your booking request is accepted.');
        return (new MailMessage)
            ->subject(__('Booking Request'))
            ->greeting(__('Hi :name, ', ['name' => $notifiable->name]))
            ->line($body)
            ->action('Show Request', route('site.booking-requests'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $body = $this->booking->status == 'denied' ? __('Unfortunately, Your booking request is rejected.')
            : __('Congratulation, Your booking request is accepted.');
        return [
            'title' => __('Booking Request'),
            'body' => $body,
            'url' => route('site.booking-requests'),
        ];
    }
}
