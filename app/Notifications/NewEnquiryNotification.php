<?php

namespace App\Notifications;

use App\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewEnquiryNotification extends Notification
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
        $enquiry = $this->enquiry;
        $about = $enquiry->subject_name
            ? $enquiry->source . ' - ' . $enquiry->subject_name
            : ($enquiry->source ?: 'Website');
        $from = trim(implode(', ', array_filter([$enquiry->city, $enquiry->state])));

        // Every value typed by the visitor is escaped before it goes into HTML.
        $mail = (new MailMessage)
            ->subject('New enquiry from ' . $enquiry->name)
            ->line(new HtmlString('<b>' . e($enquiry->name) . '</b> enquired about <b>' . e($about) . '</b>' . ($from ? ' (' . e($from) . ')' : '') . '.'))
            ->line(new HtmlString('Mobile: <b>' . e($enquiry->phone_number) . '</b>'));

        if ($enquiry->email) {
            $mail->line(new HtmlString('Email: <b>' . e($enquiry->email) . '</b>'));
        }
        if ($enquiry->message) {
            $mail->line(new HtmlString('Message: ' . nl2br(e($enquiry->message))));
        }

        return $mail->action('Open enquiries', route('enquiries.index'));
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
