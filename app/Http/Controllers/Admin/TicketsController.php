<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\TicketType;
use App\Ticket;
use App\Website;
use App\Client;
use Auth;

class TicketsController extends AdminBaseController
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

    public function index(){
        if(!permissions("tickets_index"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $tickets        = Ticket::with("type", "website")->where("parent_id", 0)->get();
        foreach ($tickets as $ticket) {
            $dates = [$ticket->created_at];
            $dates2 = [];
            foreach ($ticket->replies as $reply){
                array_push($dates, $reply->created_at);
                array_push($dates2, $reply->created_at);
                if($reply->created_at == max($dates2)){
                    $ticket->last_reply_type = ($reply->user_id == 0) ? "client" : "user";
                    $ticket->last_reply_user = ($reply->user_id == 0) ? @$reply->client->name : @$reply->user->name;
                }
            }
            $ticket->the_date = max($dates);
        }
        $tickets = $tickets->sort(function ($a, $b) {
            return ($a->the_date < $b->the_date);
        });

        return view("admin.tickets.index", compact("ticket_types", "tickets"));
    }

    public function add(){
        if(!permissions("tickets_add"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $clients        = Client::with("websites")->where("id", "!=", 1)->orderby("created_at", "asc")->get();

        return view("admin.tickets.add", compact("ticket_types", "websites", "clients"));
    }

    public function send(Request $request){
        if(!permissions("tickets_add"))
            return redirect()->route("admin.settings.no_permissions");

        $website                = Website::find($request->website_id);
        if(!$website)
            return back();

        $ticket                 = new Ticket;
        $ticket->client_id      = @$website->client_id;
        $ticket->parent_id      = 0;
        $ticket->name           = $request->name;
        $ticket->ticket_type_id = $request->ticket_type_id;
        $ticket->website_id     = $request->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/".$website->client_id);
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->status         = 0;
        $ticket->save();

        return redirect()->route("admin.tickets.index")->with("success", __("l.success_save"));
    }

    public function delete($id = null){
        if(!permissions("tickets_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket = Ticket::with("replies")->where("id", $id)->first();
        if(!$ticket)
            return back();

        foreach ($ticket->replies as $reply){
            $files = ($reply->files) ? explode(";", $reply->files) : [];
            foreach ($files as $file){
                if(file_exists(storage_path("app/".$file)))
                    unlink(storage_path("app/".$file));
            }
            $reply->delete();
        }

        $files = ($ticket->files) ? explode(";", $ticket->files) : [];
        foreach ($files as $file){
            if(file_exists(storage_path("app/".$file)))
                unlink(storage_path("app/".$file));
        }
        $ticket->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function edit($id = null){
        if(!permissions("tickets_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket = Ticket::find($id);
        if(!$ticket)
            return back();

        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $websites       = Website::where("client_id", $ticket->client_id)->orderby("created_at", "asc")->get();

        return view("admin.tickets.edit", compact("ticket_types", "websites", "ticket"));
    }

    public function update(Request $request){
        if(!permissions("tickets_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket                 = Ticket::find($request->id);
        if(!$ticket)
            return back();

        $ticket->name           = $request->name;
        $ticket->ticket_type_id = $request->ticket_type_id;
        $ticket->website_id     = $request->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/".$ticket->client_id);
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->save();

        return redirect()->route("admin.tickets.index")->with("success", __("l.success_save"));
    }

    public function show($id = null){
        if(!permissions("tickets_show"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket = Ticket::with("replies")->where("id", $id)->first();
        if(!$ticket)
            return back();

        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $websites       = Website::where("client_id", $ticket->client_id)->orderby("created_at", "asc")->get();

        return view("admin.tickets.show", compact("ticket_types", "websites", "ticket"));
    }

    public function reply(Request $request){
        if(!permissions("tickets_show"))
            return redirect()->route("admin.settings.no_permissions");

        $tickett = Ticket::find($request->id);
        if(!$tickett)
            return back();

        $client_id              = @$this->client->id;
        $ticket                 = new Ticket;
        $ticket->client_id      = 1;
        $ticket->parent_id      = $request->id;
        $ticket->user_id        = Auth::user()->id;
        $ticket->name           = " ";
        $ticket->ticket_type_id = $tickett->ticket_type_id;
        $ticket->website_id     = $tickett->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/1");
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->status         = 1;
        $ticket->save();

        return back()->with("success", __("l.success_save"));
    }

    public function status($id = null, $status = 1){
        if(!permissions("tickets_open_close"))
            return redirect()->route("admin.settings.no_permissions");

        $ticket = Ticket::where("id", $id)->first();
        if(!$ticket)
            return back();

        $ticket->status = $status;
        $ticket->save();

        return redirect()->route("admin.tickets.index")->with("success", __("l.success_save"));
    }

    public function download_attachement($id = null, $num = 1){
        $ticket = Ticket::find($id);
        if(!$ticket)
            return back();

        $files = ($ticket->files) ? explode(";", $ticket->files) : [];
        if(isset($files[$num])){
            if(file_exists(storage_path("app/".$files[$num])))
                return response()->download(storage_path("app/".$files[$num]));
            else
                return back();
        }
        return back();
    }

}
