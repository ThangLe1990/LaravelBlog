<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
//    use Queueable;

    // change as you want
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->subject('Verify Email Address')
            ->line( 'Nơi này để xác thực mail' )
            ->action(
                 ('Nhấn vào đây để xác thực mail.xin cảm ơn'),
                $this->verificationUrl($notifiable)
            )
            ->line('Nếu chưa có tài khoản, bạn tạo lại tài khoản mới nhé')
            ->line('Le Dinh Thang');

    }
}