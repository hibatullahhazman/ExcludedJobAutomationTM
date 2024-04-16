<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MainController;
use App\Providers\RouteServiceProvider;

class loginController extends Controller
{
    public function username(){
        return 'login';
    }
    //
    public function show(){
        return view('auth.login');
    }

    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect('login');
    }

    public function handle(Request $request)
    {
        $credentials = $request->validate([
          'login' => 'required'
        ]);

        $user = User::where('login',$request->login)->firstorFail();
        if($user){
            auth()->login($user);
            if(auth()->check()){
                $login = auth()->user()->login;
                $name = auth()->user()->name;
                $request->session()->put('login',$login);
                $request->session()->put('name',$name);
                $list = (new MainController)->index();
                return redirect()->intended('home')->with('list');
            }
        }
    }

}
