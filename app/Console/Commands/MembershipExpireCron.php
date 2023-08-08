<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MemberExpireNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class MembershipExpireCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return info('hello');
        $now = now();
        User::query()
        ->WhereHas('memberships', function ($query)  use($now){
            $query->Where(function ($query) use ($now) {
                $query->where('memberships.monthly_charge', 0)
                    ->whereDate('subscriptions.expire_date', $now);
            })
            ->orWhere(function($query) use ($now){
                $query->where('memberships.monthly_charge','!=',0)
                ->whereDate('monthly_charge_date', $now);
            });
        })
        ->chunk(100, function ($users)  {
            foreach ($users as $user) {
                Notification::send($user, new MemberExpireNotification($user));
            }
        });
    }
}
