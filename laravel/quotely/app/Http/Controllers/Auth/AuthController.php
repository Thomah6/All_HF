<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }
 public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

   

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    public function save(Request $request)
    {
        $this->validator($request->all());
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role'=> 'lector',
            'password' => bcrypt($request['password']),
        ]);
        $user = User::where('email', $request['email'])->firstOrFail();
        Auth::login($user);
        session()->flash('success_message', 'Votre compte a été crée');
        return redirect('/');
    }
}
