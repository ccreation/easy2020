<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use App\Subscription;
use Gabievi\Promocodes\Models\Promocode;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Website;
use App\Payment;
use App\User;
use App\Documentation;
use VisitLog;
use App\Ticket;

class HomeController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        if(!permissions("statistics"))
            return redirect()->route("admin.settings.no_permissions");

        $clients        = Client::count();
        $websites       = Website::where("client_id", "!=", 1)->count();
        $templates      = Website::where("client_id", 1)->count();
        $payments       = Payment::where("status", "accepted")->sum('total');
        $visits         = DB::table("visitlogs")->count();
        $users          = User::count();
        $documentations = Documentation::count();
        $coupons        = DB::table("promocodes")->count();
        $websitesss     = Website::all();

        $visitlogs1     = DB::table('visitlogs')->select("id", "website_id")->distinct('website_id')->get();
        $visitlogs1x    = [];
        foreach ($visitlogs1 as $v) $visitlogs1x[$v->website_id] = isset($visitlogs1x[$v->website_id]) ? $visitlogs1x[$v->website_id]+1 : 1;
        arsort($visitlogs1x);
        $visitlogs1x    = array_slice($visitlogs1x, 0, 10, true);
        $visitlogs1y    = collect();
        foreach ($visitlogs1x as $wid => $n){
            foreach ($websitesss as $w){
                if($w->id == $wid){
                    $w->visilog = $n;
                    $visitlogs1y->add($w);
                }
            }
        }

        $templatess_ids = [];
        foreach ($websitesss as $w){
            if($w->templatee_id)
                $templatess_ids[$w->templatee_id] = isset($templatess_ids[$w->templatee_id]) ? $templatess_ids[$w->templatee_id]+1 : 1;
        }
        arsort($templatess_ids);
        $templatess_ids = array_slice($templatess_ids, 0, 10, true);
        $templatess     = collect();
        foreach ($templatess_ids as $wid => $n){
            foreach ($websitesss as $w){
                if($w->id == $wid){
                    $w->used = $n;
                    $templatess->add($w);
                }
            }
        }

        $paymentss      = Payment::whereNotNull("promocode_id")->get();
        $promocode_ids  = [];
        foreach ($paymentss as $p){
            $promocode_ids[$p->promocode_id] = isset($promocode_ids[$p->promocode_id]) ? $promocode_ids[$p->promocode_id] + 1 : 1;
        }
        arsort($promocode_ids);
        $promocode_ids = array_slice($promocode_ids, 0, 10, true);
        $promocodes     = Promocode::all();
        $promocodess    = collect();
        foreach ($promocode_ids as $id => $n){
            foreach ($promocodes as $pr)
                if($pr->id == $id){
                    $pr->paymnt = $n;
                    if(!is_array($pr->data))
                        $pr->data = json_decode($pr->data, true);
                    $promocodess->add($pr);
                }
        }

        $clientss       = Client::with("plan")->get();
        $paymentss2     = Payment::with("client")->get();
        $client_ids     = [];
        foreach ($paymentss2 as $p){
            $client_ids[$p->client_id] = isset($client_ids[$p->client_id]) ? $client_ids[$p->client_id] + intval($p->total) : intval($p->total);
        }
        arsort($client_ids);
        $client_ids     = array_slice($client_ids, 0, 10, true);
        $clientsss      = collect();
        foreach ($client_ids as $id => $t){
            foreach ($clientss as $c)
                if($c->id == $id){
                    $c->total = $t;
                    $clientsss->add($c);
                }
        }

        $subscription_days = [];
        foreach ($clientss as $client){
            $subscription = Subscription::where(["status" => "accepted", "plan_id" => $client->plan_id])->where("client_id", $client->id)->orderby("created_at", "desc")->first();
            $client->subscription = $subscription;
            if($client->subscription):
                $subscription_date = \Carbon\Carbon::parse($client->subscription->subscription_date);
                $subscription_end =  $subscription_date->addMonth(intval($client->subscription->months_number))->addYear(intval($client->subscription->years_number));
                $now = \Carbon\Carbon::now();
                $subscription_days[$client->id] = $subscription_end->diffInDays($now);
            endif;
        }
        asort($subscription_days);
        $subscription_days     = array_slice($subscription_days, 0, 10, true);
        $subscription_days_clients = collect();
        foreach ($subscription_days as $id => $d){
            foreach ($clientss as $c){
                if($c->id == $id){
                    $c->days = $d;
                    $subscription_days_clients->add($c);
                }
            }
        }

        $subscription_created_at = [];
        foreach ($clientss as $client) {
            if ($client->subscription):
                $client->subscription_created_at = $client->subscription->created_at;
                $now = \Carbon\Carbon::now();
                $dif = $client->subscription_created_at->diffInDays($now);
                $subscription_created_at[$client->id] = $dif;
            endif;
        }
        asort($subscription_created_at);
        $subscription_created_at     = array_slice($subscription_created_at, 0, 10, true);
        $subscription_created_at_clients = collect();
        foreach ($subscription_created_at as $id => $d){
            foreach ($clientss as $c){
                if($c->id == $id){
                    $c->dayss = $d;
                    $subscription_created_at_clients->add($c);
                }
            }
        }

        $plans      = Plan::withCount("clients")->get();

        $my_size = 0;
        $total_space = 0;
        foreach ($clientss as $client){
            $size0 = 0;
            $f = storage_path("app/uploads/client/".$client->id);
            if(is_dir($f)){
                $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
                $size = fgets ( $io, 4096);
                $size = substr ( $size, 0, strpos ( $size, "\t" ) );
                $size0 += $size;
                pclose ( $io );
            }
            $f = storage_path("app/uploads/clients/".$client->id);
            if(is_dir($f)){
                $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
                $size = fgets ( $io, 4096);
                $size = substr ( $size, 0, strpos ( $size, "\t" ) );
                $size0 += $size;
                pclose ( $io );
            }
            $client->my_size =  intval($size0/1024);
            if(@$client->plan->disk_space != 0){
                $total_space += intval(@$client->plan->disk_space);
                $my_size += intval($client->my_size);
            }
        }

        $tickets = Ticket::with("type", "website")->where("parent_id", 0)->orderBy('created_at', 'desc')->take(5)->get();

        return view("admin.home", compact("clients", "websites", "templates", "payments", "visits", "users", "documentations", "coupons",
            "visitlogs1y", "templatess", "promocodess", "clientsss", "subscription_days_clients", "subscription_created_at_clients", "plans", "clientss",
            "my_size", "total_space", "tickets"));
    }
}
