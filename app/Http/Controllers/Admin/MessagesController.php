<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Message2;

class MessagesController extends AdminBaseController
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
     * Show the general visitors messages.
     *
     * @return a view of messages index
     */
    public function index(){

        $messages = Message2::orderby("created_at", "desc")->get();

        return view('admin.messages.index', compact("messages"));
    }

    /**
     * Delete the message
     * @param  Message2 id  $id
     * @return a redirect to messages list (index)
     */
    public function delete($id=null){
        if($id!=1){
            $message           = Message2::find($id);
            $message->delete();
        }

        return back()->with("success", __("l.success_delete"));
    }

}
