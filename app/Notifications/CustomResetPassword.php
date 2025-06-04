<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends BaseResetPassword
{
  use Queueable;

  public function __construct(string $token)
  {
    $this->token = $token;
  }

  public function via($notifiable): array
  {
    return ['mail'];
  }

  public function toMail($notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject(__('Reset Password'))
      ->greeting(__('Hello!'))
      ->line(__('You are receiving this email because we received a password reset request for your account.'))
      ->action(__('Reset Password'), $this->resetUrl($notifiable))
      ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
      ->line(__('If you did not request a password reset, no further action is required.'));
  }

  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
