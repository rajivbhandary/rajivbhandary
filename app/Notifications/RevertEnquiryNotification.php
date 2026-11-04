<?php

namespace App\Notifications;

use App\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RevertEnquiryNotification extends Notification
{
    use Queueable;

    protected $enquiry;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
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
        $subject = $this->enquiry->subject_name;
        $intro = $subject
            ? new HtmlString('Thank you for your interest in <b>' . e($subject) . '</b>. We have received your enquiry.')
            : 'Thank you for contacting Perks Properties. We have received your enquiry.';

        return (new MailMessage)
            ->subject('We received your enquiry - Perks Properties')
            ->greeting('Hello ' . $this->enquiry->name . ',')
            ->line($intro)
            ->line('One of our property advisors will call you on ' . $this->enquiry->phone_number . ' shortly.')
            ->line('If you did not make this enquiry, you can ignore this email.');
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
