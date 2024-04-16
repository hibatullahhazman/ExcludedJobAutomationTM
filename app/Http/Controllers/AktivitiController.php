<?php

namespace App\Http\Controllers;

use App\Models\aktiviti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use exception;

class AktivitiController extends Controller
{
    public function index(){
        if(session()->has('login')){
        $aktiviti = aktiviti::all();
        //dd($aktiviti);
        return view('aktiviti.index',compact('aktiviti'));
        }

        return redirect('login');
    }

}
