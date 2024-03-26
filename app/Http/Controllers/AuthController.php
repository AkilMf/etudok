<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        //validation des informations d'identification de l'utilisateur par rapport au système d'authentification.
        //mostafa@mostafa.ca / JYSuu78??
        if (!Auth::validate($credentials)) {
            return redirect(route('login'))
                ->withErrors('Password incorrect')
                ->withInput(); // for Old 
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials); // info user

        //connecter l'utilisateur en conservant son état d'authentification dans l'application.
        Auth::login($user);
        //return Auth::check();
        return redirect()->intended(route('etudiant.welcome'))->withSuccess(trans('successfully') . ' ' . trans('login'));  // intended() : redirect vers la page recherchee

    }

    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
