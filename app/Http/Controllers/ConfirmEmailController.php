<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        
        $user = User::where('confirm_token',request('token'))->first();

        if($user){
            $user->confirm();
            return redirect('/');
        }
    }
}
