<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
  use Queueable;

  public function __construct()
  {
    //
  }

  public function via($notifiable): array
  {
    return ['mail'];
  }

  public function toMail($notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject(__('Verify Email Address'))
      ->greeting(__('Hello!'))
      ->line(__('Welcome to Reshrink!'))
      ->line(__('Please click the button below to verify your email address and activate your account.'))
      ->action(__('Verify Email Address'), $this->verificationUrl($notifiable))
      ->line(__('If you did not sign up for Reshrink, please ignore this email.'));
  }

  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
