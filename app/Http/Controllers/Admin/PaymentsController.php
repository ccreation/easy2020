<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Payment;
use DB;
use Auth;
use App\Client;
use App\Website;
use App\CatgeoryWebsite;
use App\PageBlockMeta;
use App\PageBlock;
use App\Page;
use App\Post;
use App\Slider;
use App\Category;
use App\Menu;
use App\ClientUser;
use App\Subscription;
use App\Plan;
use Gabievi\Promocodes\Models\Promocode;

class PaymentsController extends AdminBaseController
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
     * Display a listing of plans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!permissions("payments_index"))
            return redirect()->route("admin.settings.no_permissions");

        $payments = Payment::with("client", "plan", "template", "promocode", "plugin")->orderby("created_at", "desc")->get();
        foreach ($payments as $payment){
            if($payment->promocode)
                if(!is_array(@$payment->promocode->data))
                    @$payment->promocode->data = json_decode(@$payment->promocode->data, true);
        }

        return view("admin.payments.index", compact("payments"));
    }

    public function details($id = null){
        if(!permissions("payments_details"))
            return redirect()->route("admin.settings.no_permissions");

        $payment = Payment::with("client", "client_user", "plan", "template", "website", "promocode", "to_bank", "from_bank")->where("id", $id)->first();
        if($payment->promocode)
            if(!is_array(@$payment->promocode->data))
                @$payment->promocode->data = json_decode(@$payment->promocode->data, true);


        return view("admin.payments.details", compact("payment"));
    }

    public function reject($id = null){
        if(!permissions("payments_accept_reject"))
            return redirect()->route("admin.settings.no_permissions");

        $payment = Payment::with("client", "client_user", "plan", "template", "website", "promocode", "to_bank", "from_bank")->where("id", $id)->first();
        if($payment->promocode)
            if(!is_array(@$payment->promocode->data))
                @$payment->promocode->data = json_decode(@$payment->promocode->data, true);

        if($payment->template){
            DB::table("client_template")->where(["client_id" => $payment->client_id, "template_id" => $payment->template_id, "website_id" => $payment->website_id])->delete();
            $payment->status = "rejected";
            $payment->save();
        }

        if($payment->plan){
            $subscription = Subscription::where(["client_id" => $payment->client_id, "payment_id" => $payment->id])->first();
            if($subscription){
                $subscription->status = "rejected";
                $subscription->save();
            }
            $payment->status = "rejected";
            $payment->save();
        }

        if($payment->plugin){
            DB::table("client_plugin")->where(["client_id" => $payment->client_id, "plugin_id" => $payment->plugin_id])->delete();
            $payment->status = "rejected";
            $payment->save();
        }


        return redirect()->route("admin.payments.index");
    }

    public function accept($id = null){
        if(!permissions("payments_accept_reject"))
            return redirect()->route("admin.settings.no_permissions");

        $payment = Payment::with("client", "client_user", "plan", "template", "website", "promocode", "to_bank", "from_bank")->where("id", $id)->first();

        if($payment->promocode)
            if(!is_array(@$payment->promocode->data))
                @$payment->promocode->data = json_decode(@$payment->promocode->data, true);

        if($payment->template){
            DB::table("client_template")->where(["client_id" => $payment->client_id, "template_id" => $payment->template_id, "website_id" => $payment->website_id])->update(["status" => 1]);
            $payment->status = "accepted";
            $payment->save();

            $client         = Client::find($payment->client_id);
            $user_id        = $payment->client_user_id;
            $website        = Website::where(["client_id" => $client->id, "id" => $payment->website_id])->first();

            $template       = Website::where(["client_id" => 1, "id" => $payment->template_id])->first();
            if(!$template)
                return back();

            $c              = Client::find($client->id);
            $sold_templates = [];
            foreach ($c->templates as $t){
                array_push($sold_templates, $t->id);
            }

            if($website){
                // Delete website data
                foreach ($website->pages as $page){
                    $page->delete();
                }

                // Copy template general configurations
                $website->multi_lang    = $template->multi_lang;
                $website->default_lang  = $template->default_lang;
                $website->color1        = $template->color1;
                $website->color2        = $template->color2;
                $website->homepage      = $template->homepage;
                $website->topbar_type   = $template->topbar_type;
                $website->footer_type   = $template->footer_type;
                $website->templatee_id  = $template->id;
                $website->save();

                // Copy pages data
                foreach ($template->pages as $page){
                    // Copy pages
                    $new_page                       = $page->replicate();
                    $new_page->client_id            = $client->id;
                    $new_page->website_id           = $website->id;
                    $new_page->user_id              = $user_id;
                    $new_page->slug                 = $this->create_slug($client->id);
                    $new_page->name                 = $page->name;
                    $new_page->content              = $page->content;
                    $new_page->name_en              = $page->name_en;
                    $new_page->content_en           = $page->content_en;
                    $new_page->status               = $page->status;
                    $new_page->default_content_ar   = $page->default_content_ar;
                    $new_page->default_content_en   = $page->default_content_en;
                    $new_page->html_content_ar      = $page->html_content_ar;
                    $new_page->html_content_en      = $page->html_content_en;
                    $new_page->save();

                    // Copy homepage
                    if($page->id==$template->homepage){
                        $website->homepage  = $new_page->id;
                        $website->save();
                    }

                }

            }

        }

        if($payment->plan){
            $c         = Client::find($payment->client_id);
            $plan           = Plan::find($payment->plan_id);
            $subscription   = Subscription::where(["client_id" => $payment->client_id, "payment_id" => $payment->id])->first();
            if($subscription){
                $subscription->status = "accepted";
                $subscription->save();
            }
            $payment->status = "accepted";
            $payment->save();


            if($payment->tamdid==1){
                $subscription->months_number = intval($subscription->months_number) + intval($payment->months_number);
                $subscription->years_number = intval($subscription->years_number) + intval($payment->years_number);
                $subscription->save();
            } else{
                if($c and $plan){
                    $c->plan_id = $payment->plan_id;
                    $c->save();

                    if($plan->templates and is_array(unserialize($plan->templates))){
                        foreach (unserialize($plan->templates) as $id){
                            $template = Website::where(["client_id" => 1, "id" => $id])->first();
                            if($template){
                                if(!$c->templates()->where('template_id', $template)->exists())
                                    $c->templates()->attach($template->id, ["website_id" => 0, "price" => null, "status" => 1, "plan_id" => $plan->id, "payment_id" => $payment->id]);
                                else{
                                    $c->templates()->updateExistingPivot($template->id, ["website_id" => 0, "price" => null, "status" => 1, "plan_id" => $plan->id, "payment_id" => $payment->id]);
                                }
                            }
                        }
                    }

                    $sold_templates = [];
                    foreach ($c->templates as $t){
                        array_push($sold_templates, $t);
                    }
                }
            }
        }

        if($payment->plugin){
            DB::table("client_plugin")->where(["client_id" => $payment->client_id, "plugin_id" => $payment->plugin_id])->update(["status" => "accepted"]);
            $payment->status = "accepted";
            $payment->save();
        }


        return redirect()->route("admin.payments.index");
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

}
