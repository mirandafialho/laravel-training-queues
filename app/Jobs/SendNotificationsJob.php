<?php

namespace App\Jobs;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Throwable;

class SendNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Throwable
     */
    public function handle()
    {
//        User::all()->each(fn($user) =>
//            SendNotificationJob::dispatch($user)
//        );
        $jobs = [];
        foreach (User::all() as $user) {
            array_push($jobs, new SendNotificationJob($user));
        }

        Bus::batch($jobs)->name('Sending Notifications')->dispatch();
    }
}
