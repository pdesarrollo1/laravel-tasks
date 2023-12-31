<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{
    public function index()
    {
        $sessions = DB::table('sessions')->select('sessions.*','users.name')
            ->whereNotNull('user_id')
            ->leftJoin('users', 'sessions.user_id', '=', 'users.id')
            ->get();
        foreach($sessions as $session) {
           $timestamp =  $session->last_activity;
           $dateTime = date('Y-m-d H:i:s', $timestamp);
        }
       
        return view('sessions.index', compact('sessions'));
    }

    public function store(Request $request)
    {
        $input = $request->input; 

        // Buscar el registro de sesión por su ID
        $session = DB::table('sessions')->find($input);

        if ($session) {
            // Si se encuentra el registro, eliminarlo
            DB::table('sessions')->where('id', $input)->delete();
        }
        return redirect()->route('session.index');
    }
}
