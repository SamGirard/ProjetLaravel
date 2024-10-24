<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouvelleEmploye extends Notification
{
    use Queueable;

    public $employe;

    /**
     * Create a new notification instance.
     */
    public function __construct($employe)
    {
        $this->employe = $employe;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Compte Employé Créé')
            ->greeting('Bonjour,')
            ->line('Un nouveau compte employé a été créé.')
            ->line('Nom: ' . $this->employe->courriel)
            ->line('Email: ' . $this->employe->role)
            ->line('Merci de faire partie de notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
