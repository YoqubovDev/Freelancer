<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // <-- bu muhim

    public function __construct(array $data)
    {
        $this->data = $data; // <-- $this->data orqali viewga uzatamiz
    }

    public function build()
    {
        return $this->subject('Yangi fikr-mulohaza')
            ->view('feedback')  // blade fayl nomi
            ->with(['data' => $this->data]); // <-- bu joy shart
    }
}
