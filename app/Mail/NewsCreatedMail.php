<?php

namespace App\Mail;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsCreatedMail extends Mailable
{ use Queueable, SerializesModels;

    public $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function build()
    {
        return $this->subject("New News")
                    ->view('mail.news_created');
    }
}
