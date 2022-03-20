<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\TrainingNotification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public int $tries = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public User $user
    )
    {
        //
    }

//    public function middleware()
//    {
//        return [
//            new RateLimited('notifications')
//        ];
//    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new TrainingNotification());
    }
}
