<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\TicketType;
use App\Ticket;
use App\Website;

class TicketsController extends ClientBaseController
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
        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $tickets        = Ticket::with("type", "website")->where("client_id", @$this->client->id)->where("parent_id", 0)->orderby("created_at", "desc")->get();
        foreach ($tickets as $ticket) {
            $dates = [$ticket->created_at];
            foreach ($ticket->replies as $reply)
                array_push($dates, $reply->created_at);
            $ticket->the_date = max($dates);
        }
        $tickets = $tickets->sort(function ($a, $b) {
            return ($a->the_date < $b->the_date);
        });

        return view("client.tickets.index", compact("ticket_types", "tickets"));
    }

    public function add(){
        $client_id = @$this->client->id;
        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $websites       = Website::where("client_id", $client_id)->orderby("created_at", "asc")->get();

        return view("client.tickets.add", compact("ticket_types", "websites"));
    }

    public function send(Request $request){
        $client_id              = @$this->client->id;
        $ticket                 = new Ticket;
        $ticket->client_id      = $client_id;
        $ticket->parent_id      = 0;
        $ticket->name           = $request->name;
        $ticket->ticket_type_id = $request->ticket_type_id;
        $ticket->website_id     = $request->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/".$client_id);
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->status         = 0;
        $ticket->save();

        return redirect()->route("client.tickets.index")->with("success", __("l.success_save"));
    }

    public function delete($id = null){
        $ticket = Ticket::find($id);
        $ticket->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function edit($id = null){
        $ticket = Ticket::find($id);
        $client_id = @$this->client->id;
        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $websites       = Website::where("client_id", $client_id)->orderby("created_at", "asc")->get();

        return view("client.tickets.edit", compact("ticket_types", "websites", "ticket"));
    }

    public function update(Request $request){
        $client_id              = @$this->client->id;
        $ticket                 = Ticket::find($request->id);
        $ticket->client_id      = $client_id;
        $ticket->name           = $request->name;
        $ticket->ticket_type_id = $request->ticket_type_id;
        $ticket->website_id     = $request->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/".$client_id);
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->save();

        return redirect()->route("client.tickets.index")->with("success", __("l.success_save"));
    }

    public function show($id = null){
        $ticket = Ticket::with("replies")->where("id", $id)->first();
        $client_id = @$this->client->id;
        $ticket_types   = TicketType::orderby("created_at", "asc")->get();
        $websites       = Website::where("client_id", $client_id)->orderby("created_at", "asc")->get();

        return view("client.tickets.show", compact("ticket_types", "websites", "ticket"));
    }

    public function status(Request $request){
        $client_id              = @$this->client->id;
        $ticket                 = Ticket::find($request->id);
        $ticket->status           = $request->status;
        $ticket->save();

        return redirect()->route("client.tickets.index")->with("success", __("l.success_save"));
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

    public function reply(Request $request){
        $tickett = Ticket::find($request->id);
        if(!$tickett)
            return back();

        $client_id              = @$this->client->id;
        $ticket                 = new Ticket;
        $ticket->client_id      = $client_id;
        $ticket->parent_id      = $request->id;
        $ticket->name           = " ";
        $ticket->ticket_type_id = $tickett->ticket_type_id;
        $ticket->website_id     = $tickett->website_id;
        $ticket->message        = $request->message;
        $paths                  = [];
        if($request->images)
            foreach ($request->images as $file){
                $path               = $file->store("uploads/clients/".$client_id);
                array_push($paths, $path);
            }
        $ticket->files          = (empty($paths)) ? null : implode(";", $paths);
        $ticket->status         = 1;
        $ticket->save();

        return back()->with("success", __("l.success_save"));
    }

}
