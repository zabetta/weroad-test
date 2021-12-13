<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Lesson;

class LessonFull extends Mailable
{
    use Queueable, SerializesModels;

    public $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('infocoach@burbero.com', 'Burbero Box')
                ->view('emails.admin.lessonfull');
    }
}
