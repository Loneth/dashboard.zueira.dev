<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function loginView()
    {
        return view('client.login', [
            config(['app.title' => "Login"]),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginStore(Request $request)
    {
        $request->validate([
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), true)) {
            $request->session()->regenerate();

            // return redirect('home');
            return redirect('dae');
        }

        return back()->withErrors([
            'message' => 'Username or Password is invalid.',
        ]);

        // return redirect()->back()->with([
        //     'message' => 'Missing validation',
        //     'alert'   => 'alert-danger'
        // ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function registerView()
    {
        return view('client.register')->with([
            config(['app.title' => "Register"]),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerStore(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:4', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'email'    => ['required', 'string', 'min:8', 'max:255', 'unique:users', 'email'],
        ]);

        User::create([
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
            'email'         => $request->email,
        ]);

        return redirect('dae');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
