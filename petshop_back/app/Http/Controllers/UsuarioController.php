<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, "usuario" => $user];

        } else {
            return ['status' => false];
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cadastro(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'tipo' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo_id' => $data['tipo'],
            'password' => bcrypt($data['password']),
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function usuario(Request $request)
    {
        $user = $request->user();

        $query = User::with('tipo_usuario')
            ->with('pets')
            ->with('pets.especie')
            ->where('id', $user['id'])
            ->get();

        return ['status' => true, "usuario" => $query];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        if (isset($data['password'])) {
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validacao->fails()) {
                return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
            }

            $user->password = bcrypt($data['password']);

        } else {
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
            ]);

            if ($validacao->fails()) {
                return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
            }

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->tipo_id = $data['tipo_id'];
        }

        $user->save();

        $user->token = $user->createToken($user->email)->accessToken;
        return ['status' => true, "usuario" => $user];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
