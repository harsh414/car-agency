<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create_new_customer()
    {
        return view('auth.register-customer');
    }

    public function create_new_car_rental_agent()
    {
        return view('auth.register-car-rental-agency');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store_new_customer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        $user->user_type= "customer";
        $user->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function store_new_carRentalAgent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        $user->user_type= "agent";
        $user->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


}
