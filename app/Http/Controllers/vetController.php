<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ficha_tec;
use App\Models\Patient;
use App\Models\register_users;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class vetController extends Controller
{
    public function home()
    {

        $search = request('search');

        if ($search) {

            $registros = Patient::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $registros = Patient::all();
        }


        return view('home', ['registros' => $registros, 'search' => $search]);
    }

    public function ficha()
    {

        return view('fichaTecnica/ficha');
    }


    public function loginUser()
    {

        return view('loginPage/login');
    }

    public function cadastroUser()
    {
        return view('loginPage/signUpPage/cadastro');
    }

    public function registerUser(Request $request)
    {

        $user = new register_users;

        $user->nome = $request->nome;
        $user->sobrenome = $request->sobrenome;
        $user->cpf = $request->cpf;
        $user->dataNascimento = $request->dataNascimento;
        $user->telefone = $request->telefone;
        $user->email = $request->email;
        $user->senha = $request->senha;

        $user->save();

        return redirect('/login');
    }

    public function dashboard()
    {

        $user = auth()->user();

        $registros = $user->ficha_tecs;

        return view('fichaTecnica.dashboard', ['registros' => $registros]);
    }
}
