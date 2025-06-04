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
      ->subject(__('Verifikasi Alamat Email'))
      ->greeting(__('Hai!'))
      ->line(__('Selamat datang di Imoji!'))
      ->line(__('Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun Anda.'))
      ->action(__('Verifikasi Alamat Email'), $this->verificationUrl($notifiable))
      ->line(__('Jika Anda tidak mendaftar di Imoji, silakan abaikan email ini.'));
  }

  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
