<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function show(Request $request){
        $this->logVisit($request);
        session()->forget('role');
        session()->forget('username');
        session()->forget('email');
        return view('login');
    }

    function submit(Request $request){
        $request->validate([
            'username' => 'required',
            'password'=>'required'
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors([
                'password' => 'Неверный логин или пароль',
            ]);
        }
        $session = session();
        $session->put('email', $user->email);
        $session->put('user_id', $user->id);
        $session->put('username', $user->username);
        $session->put('role', $user->role);
        return redirect()->route('home');
    }
    function register(Request $request){
        $this->logVisit($request);
        return view('register');
    }
    function submitRegister(RegisterRequest $request){
        if(User::where('username',$request->input('username'))->exists()){
            return back()->withErrors([
                'username' => 'Username занят',
            ]);
        }
        if(User::where('email',$request->input('email'))->exists()){
            return back()->withErrors([
                'email' => 'Email  занят',
            ]);
        }

        $user = new User();
        $user->email=$request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password1'));
        $user->save();
        return redirect()->route('login');
    }

    public function showVisits()
    {
        // Только админ может смотреть
        if (session('role') !== 'admin') {
            return redirect()->route('home')->withErrors('Доступ запрещён');
        }

        // Получаем последние 50 посещений, можно пагинацию добавить
        $visits = Visit::orderByDesc('visited_at')->paginate(50);

        return view('visits')->with('visits', $visits);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();

        return response()->json(['available' => !$exists]);
    }

}
