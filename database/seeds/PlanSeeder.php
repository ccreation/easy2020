<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $plan                       = Plan::firstOrNew(["id" => 1]);
        $plan->name_ar              = "الباقة المجانية";
        $plan->name_en              = "Free Plan";
        $plan->monthly_subscription = 0;
        $plan->annual_subscription  = 0;
        $plan->discount_percentage  = 0;
        $plan->discount_amount      = 0;
        $plan->minimum_subscription_period = 1;
        $plan->color                = "#282a3c";
        $plan->website_numbers      = 1;
        $plan->disk_space           = 1000;
        $plan->root_domain          = 0;
        $plan->multiple_users       = 0;
        $plan->default_lang         = 0;
        $plan->save();
    }
}
