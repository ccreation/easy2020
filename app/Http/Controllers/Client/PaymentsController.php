<?php

namespace App\Http\Controllers\Client;

use App\Category;
use App\Menu;
use App\Page;
use App\PageBlock;
use App\PageBlockMeta;
use App\Post;
use App\Slider;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Plan;
use App\Website;
use App\Client;
use App\Payment;
use App\Subscription;
use App\Bank;
use App\Bank2;
use App\Plugin;
use Promocodes;
use Gabievi\Promocodes\Models\Promocode;
use DB;

class PaymentsController extends ClientBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the payment form of a plan
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function plan_payment(Request $request){
        if(!cpermissions("plans_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $plan = Plan::find($request->plan_id);
        if(!$plan)
            return back();

        $months_number  = $request->months_number;
        $years_number   = intval($months_number/12);
        $months_number   = intval($months_number%12);

        $val            = ($request->months_number + $request->years_number * 12);
        if($val < intval($plan->minimum_subscription_period))
            return back()->with("error", __("l.minimum_subscription_period_note"));


        if($request->coupon){
            $promocode_check    = Promocodes::check($request->coupon);
            $promocode          = Promocode::where("code", $request->coupon)->first();
            if(!$promocode_check or !$promocode)
                return back()->with("error", __("l.coupon_error"));

            if(!is_array(@$promocode->data))
                $promocode->data = json_decode($promocode->data, true);
        }else{
            $promocode          = Promocode::where("code", "xxx")->first();
        }
        $banks          = Bank::all();
        $banks2         = Bank2::all();
        $tamdid         = $request->has("tamdid");

        $total = $plan->monthly_subscription * $months_number+$plan->annual_subscription*$years_number;
        if(@$promocode->data["reward_type"]==0)
            $total = ($total - ($total/100*floatval(@$promocode->reward)));
        else
            $total = $total - floatval($promocode->reward);
        $total = ($total<=0)?0:$total;

        $admin_settings = $this->admin_settings;
        $checkoutId = null;
        if(@$admin_settings["entity_id"] and @$admin_settings["access_token"]){
            try{
                $responseData = $this->checkout(intval($total), @$admin_settings["entity_id"]->value, @$admin_settings["access_token"]->value);
                $responseData = json_decode($responseData);
                $checkoutId = (@$responseData->id) ? @$responseData->id : null;
            }catch (\Exception $e){
                $checkoutId = null;
            }
        }
        session(['plan_payment' => [["plan_id" => $plan->id, "coupon_code" => ($request->coupon) ? $promocode->code : null,  "months_number" => $months_number, "years_number" => $years_number, "tamdid" => ($tamdid) ? 1 : 0]]]);

        return  view("client.payments.plan_payment", compact("plan", "months_number", "years_number", "promocode", "banks", "banks2", "tamdid", "checkoutId"));
    }

    function checkout($amount, $entity_id, $access_token) {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=".$entity_id .
            "&amount=".$amount .
            "&currency=SAR" .
            "&paymentType=DB&createRegistration=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function hyperpay_plan(Request $request){
        $plan_payment   = session('plan_payment');
        $plan_id        = $plan_payment[0]["plan_id"];
        $months_number  = $plan_payment[0]["months_number"];
        $years_number   = $plan_payment[0]["years_number"];
        $tamdid         = $plan_payment[0]["tamdid"];
        $coupon_code    = $plan_payment[0]["coupon_code"];

        if($request->resourcePath){
            $result = $this->check_payment($request->id);
            if(preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', @$result->result->code) or
                preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', @$result->result->code) or
                preg_match('/^(000\.200)/', @$result->result->code)){
                $client                         = $this->client;
                $user_id                        = Auth::guard("client")->user()->id;
                $plan                           = Plan::find($plan_id);
                if(!$plan)
                    return back();

                $payment                        = new Payment;

                if($coupon_code){
                    $promocode_check    = Promocodes::check($coupon_code);
                    $promocode          = Promocode::where("code", $coupon_code)->first();
                    if(!$promocode_check or !$promocode)
                        return redirect()->route("client.subscriptions.index")->with("error", __("l.coupon_error"));

                    if(!is_array(@$promocode->data))
                        $promocode->data = json_decode($promocode->data, true);

                    $total = $plan->monthly_subscription * $months_number+$plan->annual_subscription*$years_number;

                    if(@$promocode->data["reward_type"]==0)
                        $total = ($total - ($total/100*floatval($promocode->reward)));
                    else
                        $total = $total - floatval($promocode->reward);

                    $total = ($total<=0)?0:$total;
                    $total = number_format($total, 1);
                    $payment->promocode_id = $promocode->id;
                    Promocodes::apply($promocode->code);
                }else{
                    $total = number_format(floatval($plan->monthly_subscription*$months_number+$plan->annual_subscription*$years_number), 1);;
                }

                $payment->total                 = $total;
                $payment->client_user_id        = $user_id;
                $payment->client_id             = $client->id;
                $payment->plan_id               = $plan->id;
                $payment->months_number         = $months_number;
                $payment->years_number          = $years_number;
                $payment->payment_method        = "credit_card";
                $payment->months_number         = $months_number;
                $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
                $payment->status                = "accepted";
                $payment->tamdid                = $tamdid;
                $payment->save();


                $subscription                   = new Subscription;
                $subscription->payment_id       = $payment->id;
                $subscription->total            = $payment->total;
                $subscription->client_user_id   = $user_id;
                $subscription->client_id        = $client->id;
                $subscription->plan_id          = $plan->id;
                $subscription->months_number    = $months_number;
                $subscription->years_number     = $years_number;
                $subscription->subscription_date= Carbon::parse(Carbon::now()->timestamp);
                $subscription->status           = "accepted";
                $subscription->tamdid           = $tamdid;
                $subscription->save();

                $subscription   = Subscription::where(["client_id" => $payment->client_id, "plan_id" => $plan->id])->first();
                if($payment->tamdid==1){
                    $subscription->months_number = intval($subscription->months_number) + intval($payment->months_number);
                    $subscription->years_number = intval($subscription->years_number) + intval($payment->years_number);
                    $subscription->save();
                } else{
                    if($client and $plan){
                        $client->plan_id = $payment->plan_id;
                        $client->save();

                        if($plan->templates and is_array(unserialize($plan->templates))){
                            foreach (unserialize($plan->templates) as $id){
                                $template = Website::where(["client_id" => 1, "id" => $id])->first();
                                if($template){
                                    if(!$client->templates()->where('template_id', $template)->exists())
                                        $client->templates()->attach($template->id, ["website_id" => 0, "price" => null, "status" => 1, "plan_id" => $plan->id, "payment_id" => $payment->id]);
                                    else{
                                        $client->templates()->updateExistingPivot($template->id, ["website_id" => 0, "price" => null, "status" => 1, "plan_id" => $plan->id, "payment_id" => $payment->id]);
                                    }
                                }
                            }
                        }

                        $sold_templates = [];
                        foreach ($client->templates as $t){
                            array_push($sold_templates, $t);
                        }
                    }
                }

                return redirect()->route("client.subscriptions.index")->with("success", __("l.payment_success_msg_final"));
            }
            else
                return redirect()->route("client.subscriptions.index")->with("error", @$result->result->description);
        }
    }

    protected function check_payment($id){
        $url = "https://test.oppwa.com/v1/checkouts/".$id."/payment";
        $url .= "?entityId=8ac7a4c96abf404b016ac07397f4036f";
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjN2E0Yzg2YThiZTJkMjAxNmE5NmU1ZWRhMDEwNzZ8Tk05ZGVhN0RGNw=='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            curl_close($ch);
            return (json_decode($responseData));
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Apply the payment form of a plan
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function do_plan_payment(Request $request){
        if(!cpermissions("plans_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $client                         = $this->client;
        $user_id                        = Auth::guard("client")->user()->id;
        $plan                           = Plan::find($request->plan_id);
        if(!$plan)
            return back();

        $payment                        = new Payment;

        if($request->coupon_code){
            $promocode_check    = Promocodes::check($request->coupon_code);
            $promocode          = Promocode::where("code", $request->coupon_code)->first();
            if(!$promocode_check or !$promocode)
                return back()->with("error", __("l.coupon_error"));

            if(!is_array(@$promocode->data))
                $promocode->data = json_decode($promocode->data, true);

            $total = $plan->monthly_subscription * $request->months_number+$plan->annual_subscription*$request->years_number;

            if(@$promocode->data["reward_type"]==0)
                $total = ($total - ($total/100*floatval($promocode->reward)));
            else
                $total = $total - floatval($promocode->reward);

            $total = ($total<=0)?0:$total;
            $total = number_format($total, 1);
            $payment->promocode_id = $promocode->id;
            Promocodes::apply($promocode->code);
        }else{
            $total = number_format(floatval($plan->monthly_subscription*$request->months_number+$plan->annual_subscription*$request->years_number), 1);;
        }
        $payment->total                 = $total;
        $payment->client_user_id        = $user_id;
        $payment->client_id             = $client->id;
        $payment->plan_id               = $plan->id;
        $payment->months_number         = $request->months_number;
        $payment->bank_id               = $request->bank_id;
        $payment->years_number          = $request->years_number;
        $payment->payment_method        = $request->payment_method;
        $payment->transferer_name       = $request->transferer_name;
        $payment->transferer_bank       = $request->transferer_bank;
        $payment->months_number         = $request->months_number;
        $payment->transferer_account_number = $request->transferer_account_number;
        $payment->transferer_date       = $request->transferer_date;
        $payment->transferer_image      = $request->transferer_image->store("uploads/payments");
        $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
        $payment->status                = "pending";
        $payment->tamdid                = ($request->tamdid)?1:0;
        $payment->save();


        $subscription                   = new Subscription;
        $subscription->payment_id       = $payment->id;
        $subscription->total            = $payment->total;
        $subscription->client_user_id   = $user_id;
        $subscription->client_id        = $client->id;
        $subscription->plan_id          = $plan->id;
        $subscription->months_number    = $request->months_number;
        $subscription->years_number     = $request->years_number;
        $subscription->subscription_date= Carbon::parse(Carbon::now()->timestamp);
        $subscription->status           = "pending";
        $subscription->tamdid           = ($request->tamdid)?1:0;
        $subscription->save();

        return redirect()->route("client.subscriptions.index")->with("success", __("l.payment_success_msg"));
    }

    /**
     * Display the payment form of a template
     * @param int $from_id
     * @param int $to_id
     * @return \Illuminate\Http\Response
     */
    public function template_payment($from_id = null, $to_id = null){
        if(!cpermissions("templates_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;

        $website        = Website::where(["client_id" => $client->id, "id" => $to_id])->first();

        $template       = Website::where(["client_id" => 1, "id" => $from_id])->first();
        if(!$template)
            return redirect()->route("client.websites.index");


        $banks          = Bank::all();
        $banks2         = Bank2::all();

        $admin_settings = $this->admin_settings;
        $checkoutId = null;
        if(@$admin_settings["entity_id"] and @$admin_settings["access_token"]){
            try{
                $responseData = $this->checkout($template->price, @$admin_settings["entity_id"]->value, @$admin_settings["access_token"]->value);
                $responseData = json_decode($responseData);
                $checkoutId = (@$responseData->id) ? @$responseData->id : null;
            }catch (\Exception $e){
                $checkoutId = null;
            }
        }
        session(['template_payment' => [["template_id" => $template->id, "website_id" => @$website->id]]]);

        return  view("client.payments.template_payment", compact("website", "template", "banks", "banks2", "checkoutId"));
    }

    public function hyperpay_template(Request $request){
        $template_payment   = session('template_payment');
        $template_id        = $template_payment[0]["template_id"];
        $website_id         = $template_payment[0]["website_id"];

        if($request->resourcePath){
            $result = $this->check_payment($request->id);
            if(preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', @$result->result->code) or
                preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', @$result->result->code) or
                preg_match('/^(000\.200)/', @$result->result->code)){
                $client         = $this->client;
                $c              = Client::find($client->id);
                $website        = Website::where(["client_id" => $client->id, "id" => $website_id])->first();
                $template       = Website::where(["client_id" => 1, "id" => $template_id])->first();
                if(!$template)
                    return back();
                $user_id                        = Auth::guard("client")->user()->id;
                $payment                        = new Payment;
                $payment->total                 = $template->price;
                $payment->client_user_id        = $user_id;
                $payment->client_id             = $client->id;
                $payment->template_id           = $template->id;
                $payment->website_id            = @$website->id;
                $payment->payment_method        = "credit_card";
                $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
                $payment->status                = "pending";
                $payment->save();

                if (!$c->templates()->where('template_id', $template->id)->where('website_id', @$website->id)->exists())
                    $c->templates()->attach($template->id, ["website_id" => @$website->id, "price" => $template->price, "status" => 1, "payment_id" => $payment->id]);


                DB::table("client_template")->where(["client_id" => $payment->client_id, "template_id" => $payment->template_id, "website_id" => $payment->website_id])->update(["status" => 1]);
                $payment->status = "accepted";
                $payment->save();
                $client         = Client::find($payment->client_id);
                $user_id        = $payment->client_user_id;
                $website        = Website::where(["client_id" => $client->id, "id" => $payment->website_id])->first();
                $template       = Website::where(["client_id" => 1, "id" => $payment->template_id])->first();
                if(!$template)
                    return back();
                $sold_templates = [];
                foreach ($c->templates as $t){
                    array_push($sold_templates, $t->id);
                }
                if($website){
                    // Delete website data
                    foreach ($website->pages as $page){
                        foreach ($page->blocks as $block){
                            $pageBlockMetas      = PageBlockMeta::where(["block_id" => $block->id, "client_id" => $client->id])->get();
                            foreach ($pageBlockMetas as $item){
                                if($item->type =="image" or $item->type=="image" or $item->type=="links" or $item->type=="youtube"){
                                    if($item->value){
                                        $path   = str_replace(route("client.homepage"), base_path(), $item->value);
                                        if($path and file_exists($path) and is_file($path))
                                            unlink($path);
                                    }
                                }
                                if($item->old_image){
                                    $path   = str_replace(route("client.homepage"), base_path(), $item->old_image);
                                    if($path and file_exists($path) and is_file($path))
                                        unlink($path);
                                }
                                $item->delete();
                            }
                            $posts              = Post::where(["client_id" => $client, "block_id" => $block->id])->get();
                            foreach ($posts as $item){
                                if($item->image){
                                    $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                                    if($path and file_exists($path) and is_file($path))
                                        unlink($path);
                                }if($item->old_image){
                                    $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                                    if($path and file_exists($path) and is_file($path))
                                        unlink($path);
                                }
                                $item->delete();
                            }
                            Category::where(["client_id" => $client, "block_id" => $block->id])->delete();
                            $block->delete();
                        }
                        $posts              = Post::where(["client_id" => $client, "page_id" => $page->id])->get();
                        foreach ($posts as $item){
                            if($item->image){
                                $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                                if($path and file_exists($path) and is_file($path))
                                    unlink($path);
                            }if($item->old_image){
                                $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                                if($path and file_exists($path) and is_file($path))
                                    unlink($path);
                            }
                            $item->delete();
                        }
                        $page->delete();
                    }
                    PageBlock::where(["website_id" => $website->id, "client_id" => $client->id])->delete();
                    $sliders                    = Slider::where(["website_id" => $website->id, "client_id" => $client->id])->get();
                    foreach ($sliders as $item){
                        if($item->image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                            if($path and file_exists($path) and is_file($path))
                                unlink($path);
                        }if($item->old_image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                            if($path and file_exists($path) and is_file($path))
                                unlink($path);
                        }
                        $item->delete();
                    }
                    Menu::where(["website_id" => $website->id, "client_id" => $client->id])->delete();
                    $posts              = Post::where("client_id", $client->id)->whereNull("page_id")->get();
                    foreach ($posts as $item){
                        if($item->image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                            if($path and file_exists($path) and is_file($path))
                                unlink($path);
                        }if($item->old_image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                            if($path and file_exists($path) and is_file($path))
                                unlink($path);
                        }
                        $item->delete();
                    }

                    // Copy template general configurations
                    $website->multi_lang    = $template->multi_lang;
                    $website->default_lang  = $template->default_lang;
                    $website->homepage      = $template->homepage;
                    $website->topbar_type   = $template->topbar_type;
                    $website->footer_type   = $template->footer_type;
                    $website->templatee_id  = $template->id;
                    $website->save();

                    // Copy pages data
                    foreach ($template->pages as $page){
                        // Copy pages
                        $new_page               = $page->replicate();
                        $new_page->client_id    = $client->id;
                        $new_page->website_id   = $website->id;
                        $new_page->user_id      = $user_id;
                        $new_page->slug   = $this->create_slug($client->id);
                        $new_page->save();
                        // Copy blocks data
                        foreach ($page->blocks as $block){
                            // Copy blocks
                            $new_block              = $block->replicate();
                            $new_block->client_id    = $client->id;
                            $new_block->page_id      = $new_page->id;
                            $new_block->save();
                            // Copy blocks metas data
                            $pageBlockMetas      = PageBlockMeta::where(["block_id" => $block->id, "client_id" => 1, "meta_id" => 0])->get();
                            foreach ($pageBlockMetas as $meta){
                                // Copy blocks metas
                                $new_block_meta               = $meta->replicate();
                                $new_block_meta->client_id    = $client->id;
                                $new_block_meta->block_id     = $new_block->id;
                                $new_block_meta->save();
                                if($meta->type =="image" or $meta->type=="image" or $meta->type=="links" or $meta->type=="youtube"){
                                    if($meta->value){
                                        $path   = str_replace(route("client.homepage"), base_path(), $meta->value);
                                        if($path and file_exists($path) and is_file($path)){
                                            $new_path = str_replace(basename($path), time().basename(), $path);
                                            $new_block_meta->value = $new_path;
                                        }
                                    }
                                }
                                if($meta->old_image){
                                    $path   = str_replace(route("client.homepage"), base_path(), $meta->old_image);
                                    if($path and file_exists($path) and is_file($path)){
                                        $new_path = str_replace(basename($path), time().basename(), $path);
                                        $new_block_meta->old_image = $new_path;
                                    }
                                }
                                $new_block_meta->save();
                                // Copy blocks metas metas data
                                $pageBlockMetasMetas           = PageBlockMeta::where(["block_id" => $block->id, "client_id" => 1, "meta_id" => $meta->id])->get();
                                foreach ($pageBlockMetasMetas as $metameta){
                                    // Copy blocks metas metas
                                    $new_block_meta_meta               = $metameta->replicate();
                                    $new_block_meta_meta->client_id    = $client->id;
                                    $new_block_meta_meta->block_id     = $new_block->id;
                                    $new_block_meta_meta->meta_id      = $new_block_meta->id;
                                    $new_block_meta_meta->save();
                                    if($metameta->type =="image" or $metameta->type=="image" or $metameta->type=="links" or $metameta->type=="youtube"){
                                        if($metameta->value){
                                            $path   = str_replace(route("client.homepage"), base_path(), $metameta->value);
                                            if($path and file_exists($path) and is_file($path)){
                                                $new_path = str_replace(basename($path), time().basename(), $path);
                                                $new_block_meta_meta->value = $new_path;
                                            }
                                        }
                                    }
                                    if($metameta->old_image){
                                        $path   = str_replace(route("client.homepage"), base_path(), $metameta->old_image);
                                        if($path and file_exists($path) and is_file($path)){
                                            $new_path = str_replace(basename($path), time().basename(), $path);
                                            $new_block_meta_meta->old_image = $new_path;
                                        }
                                    }
                                    $new_block_meta_meta->save();
                                }
                            }
                            // Copy posts data
                            $posts              = Post::with("category")->where(["client_id" => 1, "block_id" => $block->id])->get();
                            $categoriess = [];
                            foreach ($posts as $item){
                                // Copy posts
                                $new_post               = $item->replicate();
                                $new_post->client_id    = $client->id;
                                $new_post->user_id      = $user_id;
                                $new_post->page_id      = $new_page->id;
                                $new_post->block_id     = $new_block->id;
                                $new_post->save();
                                if($item->image){
                                    $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                                    if($path and file_exists($path) and is_file($path)){
                                        $new_path = str_replace(basename($path), time().basename(), $path);
                                        $new_post->image = $new_path;
                                    }
                                }if($item->old_image){
                                    $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                                    if($path and file_exists($path) and is_file($path)){
                                        $new_path = str_replace(basename($path), time().basename(), $path);
                                        $new_post->old_image = $new_path;
                                    }
                                }
                                $new_post->save();
                                // Copy categories
                                if($item->category and $item->category_id!=0){
                                    array_push($categoriess, $item->category_id);
                                    $new_category               = $item->category->replicate();
                                    $new_category->client_id    = $client->id;
                                    $new_category->block_id     = $new_block->id;
                                    $new_category->page_id      = $new_page->id;
                                    $new_category->save();
                                    $new_post->category_id      = $new_category->id;
                                    $new_post->save();
                                }
                            }
                            $categories = Category::where(["client_id" => 1, "block_id" => $block->id])->get();
                            foreach ($categories as $category){
                                if(!in_array($category->id, $categoriess)){
                                    $new_category               = $category->replicate();
                                    $new_category->client_id    = $client->id;
                                    $new_category->block_id     = $new_block->id;
                                    $new_category->page_id      = $new_page->id;
                                    $new_category->save();
                                }
                            }
                        }
                        // Copy homepage
                        if($page->id==$template->homepage){
                            $website->homepage  = $new_page->id;
                            $website->save();
                        }

                    }
                    // Copy blocks without pages
                    $pageBlocks = PageBlock::where(["website_id" => $template->id, "client_id" => 1])->whereNull("page_id")->get();
                    foreach ($pageBlocks as $block){
                        $new_block                  = $block->replicate();
                        $new_block->client_id       = $client->id;
                        $new_block->website_id      = $website->id;
                        $new_block->page_id         = null;
                        $new_block->save();
                        // Copy blocks metas data
                        $pageBlockMetas      = PageBlockMeta::where(["block_id" => $block->id, "client_id" => 1, "meta_id" => 0])->get();
                        foreach ($pageBlockMetas as $meta){
                            // Copy blocks metas
                            $new_block_meta               = $meta->replicate();
                            $new_block_meta->client_id    = $client->id;
                            $new_block_meta->block_id     = $new_block->id;
                            $new_block_meta->save();
                            if($meta->type =="image" or $meta->type=="image" or $meta->type=="links" or $meta->type=="youtube"){
                                if($meta->value){
                                    $path   = str_replace(route("client.homepage"), base_path(), $meta->value);
                                    if($path and file_exists($path) and is_file($path)){
                                        $new_path = str_replace(basename($path), time().basename(), $path);
                                        $new_block_meta->value = $new_path;
                                    }
                                }
                            }
                            if($meta->old_image){
                                $path   = str_replace(route("client.homepage"), base_path(), $meta->old_image);
                                if($path and file_exists($path) and is_file($path)){
                                    $new_path = str_replace(basename($path), time().basename(), $path);
                                    $new_block_meta->old_image = $new_path;
                                }
                            }
                            $new_block_meta->save();
                            // Copy blocks metas metas data
                            $pageBlockMetasMetas           = PageBlockMeta::where(["block_id" => $block->id, "client_id" => 1, "meta_id" => $meta->id])->get();
                            foreach ($pageBlockMetasMetas as $metameta){
                                // Copy blocks metas metas
                                $new_block_meta_meta               = $metameta->replicate();
                                $new_block_meta_meta->client_id    = $client->id;
                                $new_block_meta_meta->block_id     = $new_block->id;
                                $new_block_meta_meta->meta_id      = $new_block_meta->id;
                                $new_block_meta_meta->save();
                                if($metameta->type =="image" or $metameta->type=="image" or $metameta->type=="links" or $metameta->type=="youtube"){
                                    if($metameta->value){
                                        $path   = str_replace(route("client.homepage"), base_path(), $metameta->value);
                                        if($path and file_exists($path) and is_file($path)){
                                            $new_path = str_replace(basename($path), time().basename(), $path);
                                            $new_block_meta_meta->value = $new_path;
                                        }
                                    }
                                }
                                if($metameta->old_image){
                                    $path   = str_replace(route("client.homepage"), base_path(), $metameta->old_image);
                                    if($path and file_exists($path) and is_file($path)){
                                        $new_path = str_replace(basename($path), time().basename(), $path);
                                        $new_block_meta_meta->old_image = $new_path;
                                    }
                                }
                                $new_block_meta_meta->save();
                            }
                        }
                        // Copy posts data
                        $posts              = Post::with("category")->where(["client_id" => 1, "block_id" => $block->id])->get();
                        $categoriess = [];
                        foreach ($posts as $item){
                            // Copy posts
                            $new_post               = $item->replicate();
                            $new_post->client_id    = $client->id;
                            $new_post->user_id      = $user_id;
                            $new_post->page_id      = $new_page->id;
                            $new_post->block_id     = $new_block->id;
                            $new_post->save();
                            if($item->image){
                                $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                                if($path and file_exists($path) and is_file($path)){
                                    $new_path = str_replace(basename($path), time().basename(), $path);
                                    $new_post->image = $new_path;
                                }
                            }if($item->old_image){
                                $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                                if($path and file_exists($path) and is_file($path)){
                                    $new_path = str_replace(basename($path), time().basename(), $path);
                                    $new_post->old_image = $new_path;
                                }
                            }
                            $new_post->save();
                            // Copy categories
                            if($item->category and $item->category_id!=0){
                                array_push($categoriess, $item->category_id);
                                $new_category               = $item->category->replicate();
                                $new_category->client_id    = $client->id;
                                $new_category->block_id     = $new_block->id;
                                $new_category->page_id      = $new_page->id;
                                $new_category->save();
                                $new_post->category_id      = $new_category->id;
                                $new_post->save();
                            }
                        }
                        $categories = Category::where(["client_id" => 1, "block_id" => $block->id])->get();
                        foreach ($categories as $category){
                            if(!in_array($category->id, $categoriess)){
                                $new_category               = $category->replicate();
                                $new_category->client_id    = $client->id;
                                $new_category->block_id     = $new_block->id;
                                $new_category->page_id      = $new_page->id;
                                $new_category->save();
                            }
                        }
                    }
                    // Copy sliders
                    $sliders                    = Slider::where(["website_id" => $template->id, "client_id" => 1])->get();
                    foreach ($sliders as $item){
                        $new_slider             = $item->replicate();
                        $new_slider->client_id  = $client->id;
                        $new_slider->website_id = $website->id;
                        $new_slider->save();
                        if($item->image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                            if($path and file_exists($path) and is_file($path)){
                                $new_path = str_replace(basename($path), time().basename(), $path);
                                $new_slider->image = $new_path;
                            }
                        }if($item->old_image){
                            $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                            if($path and file_exists($path) and is_file($path)){
                                $new_path = str_replace(basename($path), time().basename(), $path);
                                $new_slider->old_image = $new_path;
                            }
                        }
                        $new_slider->save();
                    }
                    // Copy menus
                    $menus = Menu::with("children")->where(["website_id" => $template->id, "client_id" => 1, "parent_id" => 0])->get();
                    foreach ($menus as $menu){
                        $new_menu               = $menu->replicate();
                        $new_menu->client_id    = $client->id;
                        $new_menu->website_id   = $website->id;
                        $new_menu->save();
                        foreach ($menu->children as $submenu){
                            $new_sub_menu               = $submenu->replicate();
                            $new_sub_menu->client_id    = $client->id;
                            $new_sub_menu->website_id   = $website->id;
                            $new_sub_menu->parent_id    = $new_menu->id;
                            $new_sub_menu->save();
                        }
                    }
                }

                if($website)
                    return redirect()->route("pages.indexbywebsite", $website->id)->with("success", __("l.payment_success_msg_final"));
                else
                    return redirect()->route("client.websites.choose_template")->with("success", __("l.payment_success_msg_final"));
            }else{
                return redirect()->route("client.websites.choose_template")->with("error", @$result->result->description);
            }
        }
    }

    /**
     * Apply the payment form of a template
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function do_template_payment(Request $request){
        if(!cpermissions("templates_purchase_use"))
            return redirect()->route("client.settings.no_permissions");


        $client         = $this->client;
        $c              = Client::find($client->id);

        $website        = Website::where(["client_id" => $client->id, "id" => $request->website_id])->first();

        $template       = Website::where(["client_id" => 1, "id" => $request->template_id])->first();
        if(!$template)
            return back();

        $user_id                        = Auth::guard("client")->user()->id;

        $payment                        = new Payment;

        $payment->total                 = $template->price;
        $payment->client_user_id        = $user_id;
        $payment->client_id             = $client->id;
        $payment->template_id           = $template->id;
        $payment->website_id            = @$website->id;
        $payment->bank_id               = $request->bank_id;
        $payment->payment_method        = $request->payment_method;
        $payment->transferer_name       = $request->transferer_name;
        $payment->transferer_bank       = $request->transferer_bank;
        $payment->transferer_account_number = $request->transferer_account_number;
        $payment->transferer_date       = $request->transferer_date;
        $payment->transferer_image      = $request->transferer_image->store("uploads/payments");
        $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
        $payment->status                = "pending";
        $payment->save();

        if (!$c->templates()->where('template_id', $template->id)->where('website_id', @$website->id)->exists())
            $c->templates()->attach($template->id, ["website_id" => @$website->id, "price" => $template->price, "status" => 0, "payment_id" => $payment->id]);


        return redirect()->route("client.subscriptions.index")->with("success", __("l.payment_success_msg"));
    }

    /**
     * Create the Page slug
     * @param  name from the request $request
     * @return the formatted slug
     */
    protected function create_slug($client_id){
        $slug0  = rand(111, 999);
        $slug       = $slug0;
        $search     = true;
        $repeated   = 1;
        while($search){
            $pagex = Page::where("client_id", $client_id)->where("slug", $slug)->first();
            if(!$pagex){
                $search = false;
            }else{
                $slug = $slug0."(".$repeated.")";
                $repeated ++;
            }
        }
        return $slug;
    }











    public function plugin_payment($id = null){
        if(!cpermissions("plugins_purchase"))
            return redirect()->route("client.settings.no_permissions");

        $plugin = Plugin::find($id);
        if(!$plugin)
            return back();
        $banks          = Bank::all();
        $banks2         = Bank2::all();

        $admin_settings = $this->admin_settings;
        $checkoutId = null;
        if(@$admin_settings["entity_id"] and @$admin_settings["access_token"]){
            try{
                $responseData = $this->checkout($plugin->price, @$admin_settings["entity_id"]->value, @$admin_settings["access_token"]->value);
                $responseData = json_decode($responseData);
                $checkoutId = (@$responseData->id) ? @$responseData->id : null;
            }catch (\Exception $e){
                $checkoutId = null;
            }
        }
        session(['plugin_payment' => [["plugin_id" => $plugin->id]]]);

        return  view("client.payments.plugin_payment", compact("plugin", "banks", "banks2", "checkoutId"));
    }

    public function hyperpay_plugin(Request $request){
        $plugin_payment   = session('plugin_payment');
        $plugin_id        = $plugin_payment[0]["plugin_id"];

        if($request->resourcePath){
            $result = $this->check_payment($request->id);
            if(preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', @$result->result->code) or
                preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', @$result->result->code) or
                preg_match('/^(000\.200)/', @$result->result->code)){
                $client         = $this->client;
                $c              = Client::find($client->id);

                $plugin         = Plugin::where(["id" => $plugin_id])->first();
                if(!$plugin)
                    return back();

                $user_id                        = Auth::guard("client")->user()->id;

                $payment                        = new Payment;

                $payment->total                 = $plugin->price;
                $payment->client_user_id        = $user_id;
                $payment->client_id             = $client->id;
                $payment->plugin_id             = $plugin_id;
                $payment->payment_method        = "credit_card";
                $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
                $payment->status                = "accepted";
                $payment->save();

                if (!$c->plugins()->where('plugin_id', $plugin->id)->exists())
                    $c->plugins()->attach($plugin->id, ["price" => $plugin->price, "status" => "accepted", "payment_id" => $payment->id]);

                return redirect()->route("client.subscriptions.index")->with("success", __("l.payment_success_msg_final"));
            }else{
                return redirect()->route("client.payments.plugin_payment", $plugin_id)->with("error", @$result->result->description);
            }
        }
    }

    public function do_plugin_payment(Request $request){
        if(!cpermissions("plugins_purchase"))
            return redirect()->route("client.settings.no_permissions");

    $client         = $this->client;
    $c              = Client::find($client->id);

    $plugin         = Plugin::where(["id" => $request->plugin_id])->first();
    if(!$plugin)
        return back();

    $user_id                        = Auth::guard("client")->user()->id;

    $payment                        = new Payment;

    $payment->total                 = $plugin->price;
    $payment->client_user_id        = $user_id;
    $payment->client_id             = $client->id;
    $payment->plugin_id             = $request->plugin_id;
    $payment->bank_id               = $request->bank_id;
    $payment->payment_method        = $request->payment_method;
    $payment->transferer_name       = $request->transferer_name;
    $payment->transferer_bank       = $request->transferer_bank;
    $payment->transferer_account_number = $request->transferer_account_number;
    $payment->transferer_date       = $request->transferer_date;
    $payment->transferer_image      = $request->transferer_image->store("uploads/payments");
    $payment->payment_date          = Carbon::parse(Carbon::now()->timestamp);
    $payment->status                = "pending";
    $payment->save();


    if (!$c->plugins()->where('plugin_id', $plugin->id)->exists())
        $c->plugins()->attach($plugin->id, ["price" => $plugin->price, "status" => "pending", "payment_id" => $payment->id]);


    return redirect()->route("client.subscriptions.index")->with("success", __("l.payment_success_msg"));
}

}
