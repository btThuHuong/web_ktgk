<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckoutSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Khai báo 2 biến public để View có thể đọc được dữ liệu
    public $cartDetails;
    public $totalPrice;

    /**
     * Create a new message instance.
     */
    public function __construct($cartDetails, $totalPrice)
    {
        // 2. Gán dữ liệu truyền vào từ Controller
        $this->cartDetails = $cartDetails;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // 3. Sửa lại tiêu đề của Email khi gửi đến khách
            subject: 'Xác nhận đặt hàng thành công - Cửa hàng Cây Cảnh',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // 4. Trỏ đường dẫn tới đúng file giao diện mail đã tạo ở Bước 3
            view: 'emails.checkout_success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}