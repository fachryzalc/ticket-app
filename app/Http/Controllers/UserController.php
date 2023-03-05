<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class UserController extends Controller
{
    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Ticket Reservation | Sign in",
            ]);
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            if ($user->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended('/ticket');
            } else {
                $cart = session()->get('cart');
                if ($cart == null)
                    $cart = [];

                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        Alert::error('Error', 'Login Failed!');
        return back();
    }

    public function doLogout(Request $request)
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }

    public function register(): Response
    {
        return response()
            ->view("user.register", [
                "title" => "Ticket Reservation | Register"
            ]);
    }

    public function doRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:5|max:255',
            'confirm_password' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        Alert::success('Success', 'You\'re registered!');
        return redirect('/login');
    }
}
