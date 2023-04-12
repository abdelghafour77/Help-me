<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function index()
    {
        // order by created_at desc
        $logs = Log::all()->sortByDesc('id');
        return view('logs', compact('logs'));
    }
    public function logMe($type, $message, $method, $ip)
    {
        $log = new Log();
        $log->type = $type;
        $log->message = $message;
        $log->method = $method;

        $log->user_id = Auth::user()->id;
        $log->user_role = Auth::user()->roles->first()->name;

        $log->ip = $ip;

        $log->save();
    }
}
