<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function index()
    {
        // order by created_at desc and paginate 10 logs per page
        $logs = Log::orderBy('created_at', 'desc')->paginate(10);
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
    public function edit($id)
    {
        //    return jsonresponse log with user
        $log = Log::with('user')->find($id);
        return response()->json($log);
    }
}
