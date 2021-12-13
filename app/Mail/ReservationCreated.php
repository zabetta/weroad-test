<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Lesson;

class ReservationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Lesson $lesson)
    {
        $this->user = $user;
        $this->lesson = $lesson;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@burbero.com', 'Burbero Box')
                ->view('emails.reservation.created');
    }
}
