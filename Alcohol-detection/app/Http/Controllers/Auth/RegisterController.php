<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    //public function create()
    //{
    //    return view('auth.register');
    //}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'role'=>'required',
        ]);
        $user = User::create($data);

        return redirect(route('login'));
    }
}
