<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Sign In | SimplePOS',
        ]);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your username.',
                ],
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please enter your password.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = trim(
            (string) $this->request->getPost('username')
        );

        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->where('username', $username)
            ->first();

        if (
            $user === null
            || empty($user['password'])
            || ! password_verify($password, $user['password'])
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'The username or password is incorrect.'
                );
        }

        session()->regenerate(true);

        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'full_name'  => $user['full_name'],
            'role'       => $user['role'] ?? 'Staff',
            'avatar'     => $user['avatar'] ?? null,
            'isLoggedIn' => true,
        ]);

        $destination = session()->get('intended_url') ?: '/';

        session()->remove('intended_url');

        return redirect()
            ->to($destination)
            ->with(
                'success',
                'Welcome back, ' . $user['full_name'] . '!'
            );
    }

    public function logout()
    {
        session()->remove([
            'user_id',
            'username',
            'full_name',
            'role',
            'avatar',
            'isLoggedIn',
            'intended_url',
        ]);

        session()->regenerate(true);

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'You have been signed out successfully.'
            );
    }
}