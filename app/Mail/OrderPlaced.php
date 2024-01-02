<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $order_id;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $order_id)
    {
        $this->user = $user;
        $this->order_id = $order_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // dd($this->user);
        return new Envelope(
            subject: 'Order Invoice from KZS Style',
            to: $this->user
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $order = Order::with('customer','products')->find($this->order_id);
        // dd($order);
        return new Content(
            view: 'order_placed',
            with: [
                'order' => $order
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
