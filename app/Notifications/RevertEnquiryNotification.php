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
        if($this->enquiry->isProperty() && $this->enquiry->isFre()){
            $model = $this->enquiry->getModelData();
            return (new MailMessage)
            ->subject('Perks Properties - Enquiry Revert')
            ->line(new HtmlString("We received your enquiry. Thank you so much for your interest in {$this->enquiry->model} - <strong><b>{$model->location->building_name}</strong>."))
            ->line('However, please do not hesitate to contact us for further clarification if need be.')
            ->line('Thank you for putting your trust in us');
        }else{
            return (new MailMessage)
            ->subject('Perks Properties - Enquiry Revert')
            ->line(new HtmlString("We received your enquiry. Thank you so much for your interest."))
            ->line('However, please do not hesitate to contact us for further clarification if need be.')
            ->line('Thank you for putting your trust in us');
        }
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
