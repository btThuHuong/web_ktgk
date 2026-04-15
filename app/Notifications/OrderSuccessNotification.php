<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccessNotification extends Notification
{
    use Queueable;

    private $orderData;
    public function __construct($orderData) {
    $this->orderData = $orderData; // Lưu trữ dữ liệu từ Controller [cite: 145, 147]
        }

        public function toMail($notifiable) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Đặt hàng thành công') // Tiêu đề email [cite: 158]
                ->view('email_template.don_hang_thanh_cong', ['data' => $this->orderData]); // Sử dụng view riêng [cite: 163]
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
