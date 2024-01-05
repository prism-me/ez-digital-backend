<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Cache;
use App\Listeners\NotifyForgetPasswordCreated;
use App\Events\ForgetPasswordMail;

use App\Listeners\NotifyRegisterCreated;
use App\Events\RegisterMail;

use App\Listeners\NotifyBookingConfirmedCreated;
use App\Events\BookingConfirmedMail;

use App\Listeners\NotifyClientBookingConfirmedCreated;
use App\Events\ClientBookingConfirmedMail;

use App\Listeners\NotifyUserContactUsCreated;
use App\Events\UserContactUsMail;

use App\Listeners\NotifyClientContactUsCreated;
use App\Events\ClientContactUsMail;

use App\Listeners\NotifyClientSubscriberCreated;
use App\Events\ClientSubscriberMail;

use App\Listeners\NotifyUserSubscriberCreated;
use App\Events\UserSubscriberMail;

use App\Listeners\NotifyClientInteriorQuotationCreated;
use App\Events\ClientInteriorQuotationMail;

use App\Listeners\NotifyClientListYourPropertyCreated;
use App\Events\ClientListYourPropertyMail;

use App\Listeners\NotifyUserListYourPropertyCreated;
use App\Events\UserListYourPropertyMail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ForgetPasswordMail::class => [
            NotifyForgetPasswordCreated::class,
        ],
        RegisterMail::class => [
            NotifyRegisterCreated::class,
        ],
        BookingConfirmedMail::class => [
            NotifyBookingConfirmedCreated::class,
        ],
        ClientBookingConfirmedMail::class => [
            NotifyClientBookingConfirmedCreated::class,
        ],
        UserContactUsMail::class => [
            NotifyUserContactUsCreated::class,
        ],
       
        ClientContactUsMail::class => [
            NotifyClientContactUsCreated::class,
        ],
        UserSubscriberMail::class => [
            NotifyUserSubscriberCreated::class,
        ],
       
        ClientSubscriberMail::class => [
            NotifyClientSubscriberCreated::class,
        ],

        ClientInteriorQuotationMail::class => [
            NotifyClientInteriorQuotationCreated::class,
        ],
        ClientListYourPropertyMail::class => [
            NotifyClientListYourPropertyCreated::class,
        ],
        UserListYourPropertyMail::class => [
            NotifyUserListYourPropertyCreated::class,
        ],

       
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
