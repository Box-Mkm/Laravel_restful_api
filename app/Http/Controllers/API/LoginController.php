<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Instantiate a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.basic.once')->except(['index', 'show']);
    }
    public function login()
    {
        $Accesstoken = Auth::user()->createToken('Access Token')->accessToken;
        return response(['User' => new UserResource(Auth::user()), 'Access Token' => $Accesstoken]);
    }
}
