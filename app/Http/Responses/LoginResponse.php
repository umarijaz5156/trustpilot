<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class LoginResponse implements ContractsLoginResponse
{


    public function toResponse($request)
    {

       
        
        $email = $request->input('email');
        $password = $request->input('password');
        Session::put('email', $email);
        Session::put('password', $password);
            
      
        // redirect to normal home
        return redirect()->intended(config('fortify.home'));
        
    }
}