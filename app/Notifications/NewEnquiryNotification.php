<?php

namespace App\Notifications;

use App\Enquiry;
use App\Property;
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
        if($this->enquiry->isProperty() || $this->enquiry->isFre() ){
            $model = $this->enquiry->getModelData();
            return (new MailMessage)
                ->subject("New Enquiry")
                ->line(new HtmlString("A new enquiry was made by <b>{$this->enquiry->name}</b> from <b>{$this->enquiry->city},  {$this->enquiry->state}</b> for {$this->enquiry->source} - <b>{$model->location->building_name}</b>."))
                ->line(new HtmlString("Email: <b>{$this->enquiry->email}</b>"))
                ->line(new HtmlString("Phone Number: <b>{$this->enquiry->phone_number}</b>"))
                ->line('Thank you for using our application!');
        }else{
            return (new MailMessage)
            ->subject("New Enquiry")
            ->line(new HtmlString("A new enquiry was made by <b>{$this->enquiry->name}</b> from <b>{$this->enquiry->city}- {$this->enquiry->state}</b> from {$this->enquiry->source}."))
            ->line(new HtmlString("Email: <b>{$this->enquiry->email}</b>"))
            ->line(new HtmlString("Phone Number: <b>{$this->enquiry->phone_number}</b>"))
            ->line('Thank you for using our application!');
        }
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
