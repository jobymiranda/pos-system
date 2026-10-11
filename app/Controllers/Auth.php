<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Sign In | CasaForma',
        ]);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())
            ->where('username', $username)
            ->first();

        if (
            $user === null
            || ! password_verify($password, (string) $user['password'])
        ) {
            return redirect()->back()->withInput()->with(
                'error',
                'The username or password is incorrect.'
            );
        }

        session()->regenerate(true);
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'avatar' => $user['avatar'],
            'isLoggedIn' => true,
        ]);

        $destination = session()->get('intended_url') ?: '/';
        session()->remove('intended_url');

        return redirect()->to($destination)->with(
            'success',
            'Welcome to CasaForma, ' . $user['full_name'] . '.'
        );
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with(
            'success',
            'You have been signed out safely.'
        );
    }
}