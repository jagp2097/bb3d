<?php

namespace bagrap\Listeners;

use bagrap\Events\Admin_Create_User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\MustVerifyEmail;

class SendEmailToUser
{
    use MustVerifyEmail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Admin_Create_User  $event
     * @return void
     */
    public function handle(Admin_Create_User $event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}
