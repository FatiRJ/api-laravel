<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = route('verification.verify', [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);

        return (new MailMessage)
            ->subject('Verificación de correo electrónico')
            ->line('Haga clic en el botón de abajo para verificar su dirección de correo electrónico.')
            ->action('Verificar Correo Electrónico', $verificationUrl)
            ->line('Si no creó una cuenta, no se requiere ninguna acción.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            
        ];
    }
}
