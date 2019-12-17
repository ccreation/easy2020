<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        date_default_timezone_set('Asia/Riyadh');
        $this->middleware('auth');
    }

    public function index(){
        dd("dfghjk");
    }
}
