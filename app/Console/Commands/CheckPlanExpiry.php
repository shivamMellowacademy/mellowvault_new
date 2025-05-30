<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClientPurchasedPlan;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;

class CheckPlanExpiry extends Command
{
    protected $signature = 'plans:check-expiry';
    protected $description = 'Check and update expired client subscription plans';

    public function handle()
    {
        $plans = ClientPurchasedPlan::where('is_history', 0)->get();

        foreach ($plans as $plan) {
            $subscription = SubscriptionPlan::find($plan->subscription_plan_id);

            if (!$subscription) continue;

            $paymentDate = Carbon::parse($plan->payment_date);
            $now = Carbon::now();

            // Determine expiry date based on plan_type
            switch (strtolower($subscription->plan_type)) {
                case 'monthly':
                    $expiryDate = $paymentDate->copy()->addMonth();
                    break;
                case 'quarterly':
                    $expiryDate = $paymentDate->copy()->addMonths(3);
                    break;
                case 'yearly':
                    $expiryDate = $paymentDate->copy()->addYear();
                    break;
                case 'free':
                case '0':
                    $expiryDate = null;
                    break;
                default:
                    $expiryDate = null;
                    break;
            }

            // Update is_history if plan is expired
            if ($expiryDate && $now->gt($expiryDate)) {
                $plan->is_history = 1;
                $plan->save();
                $this->info("Plan ID {$plan->id} expired and marked as history.");
            }
        }

        $this->info('Plan expiry check completed.');
    }
}

