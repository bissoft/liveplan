<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
    // public function showRegistrationForm()
    // {
    //     return view('auth.register');
    // }
    public function __construct()
    {
        
        $this->middleware('guest');
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // $request->session()->put('name', $request->name);
        // $request->session()->put('email', $request->email);
        // $request->session()->put('phone', $request->phone);
        // $request->session()->put('company_name', $request->company_name);
        // $request->session()->put('job_title', $request->job_title);
        // $request->session()->put('vat', $request->vat);
        // $request->session()->put('password', Hash::make($request->password));
        // $request->session()->put('address', $request->address);
        // $request->session()->put('job_structure', $request->password);
        // return redirect(route('stripe'));
        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    // protected function guard()
    // {
    //     return Auth::guard();
    // }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    // protected function registered(Request $request, $user)
    // {
    //     //
    // }
}
