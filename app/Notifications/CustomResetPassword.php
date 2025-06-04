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
      ->greeting(__('Hai!'))
      ->line(__('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.'))
      ->action(__('Reset Password'), $this->resetUrl($notifiable))
      ->line(__('Link reset password ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
      ->line(__('Jika Anda tidak meminta reset password, Anda tidak perlu melakukan tindakan lebih lanjut.'));
  }

  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
