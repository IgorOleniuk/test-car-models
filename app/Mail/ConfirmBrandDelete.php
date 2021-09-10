<?php

namespace App\Mail;

use App\Models\Brand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ConfirmBrandDelete extends Mailable
{
    use Queueable, SerializesModels;

    public $brand;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('car-models-app@example.com')
                    ->subject('Confirm Brand Deleting')
                    ->view('emails.confirm-brand-delete');
    }
}
