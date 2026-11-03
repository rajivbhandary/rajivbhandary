<?php

namespace App\Notifications;

use App\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class BlogVisibilityNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
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
        if($this->blog->isApproved()){
            return (new MailMessage)
                ->subject('Perks Properties - Blog Notification')
                ->line(new HtmlString("Congratulations! Your blog with title <strong>{$this->blog->title}</strong> was approved by the admin!"))
                ->action('View Blog', $this->blog->url)
                ->line('Thank you for using our application!');
        }else{
            return (new MailMessage)
                ->subject('Perks Properties -Blog Notification')
                ->line(new HtmlString("We are sorry! Your blog with title <strong>{$this->blog->title}</strong> was disapproved by the admin!"))
                ->action('Preview Blog', $this->blog->preview_url)
                ->line('Thank you for using our application!');
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
