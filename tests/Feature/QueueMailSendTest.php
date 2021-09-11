<?php

namespace Tests\Feature;

use App\Mail\ConfirmBrandDelete;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class QueueMailSendTest extends TestCase
{
    /**
     * A queue mail send test.
     *
     * @return void
     */
    public function test_queue_mail()
    {
        $user = User::factory()->create();
        $brand = new Brand();

        Mail::fake();
        Mail::to($user->email)->send(new ConfirmBrandDelete($brand));
        Mail::assertSent(ConfirmBrandDelete::class);
    }
}
