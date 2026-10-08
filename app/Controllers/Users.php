<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $userModel
                ->orderBy('full_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('users/new', [
            'title' => 'Add New User',
        ]);
    }

    public function create()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'max_length[100]',
                    'alpha_numeric_punct',
                    'is_unique[users.username]',
                ],
                'errors' => [
                    'required'  => 'Please enter a username.',
                    'is_unique' => 'That username is already being used.',
                ],
            ],

            'full_name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[150]',
                'errors' => [
                    'required' => 'Please enter the full name.',
                ],
            ],

            'role' => [
                'label' => 'Role',
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Please select a role.',
                ],
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required'   => 'Please enter a password.',
                    'min_length' => 'The password must contain at least 8 characters.',
                ],
            ],

            'password_confirm' => [
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Please confirm the password.',
                    'matches'  => 'The passwords do not match.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username' => trim(
                (string) $this->request->getPost('username')
            ),

            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),

            'role' => trim(
                (string) $this->request->getPost('role')
            ),

            'password' => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        return redirect()
            ->to('/users')
            ->with(
                'success',
                'The user account was created successfully.'
            );
    }

    public function edit(int $id): string
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'The requested user account could not be found.'
            );
        }

        return view('users/edit', [
            'title' => 'Edit User Account',
            'user'  => $user,
        ]);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'The requested user account could not be found.'
            );
        }

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'max_length[100]',
                    'alpha_numeric_punct',
                    "is_unique[users.username,id,{$id}]",
                ],
                'errors' => [
                    'required'  => 'Please enter a username.',
                    'is_unique' => 'That username is already being used.',
                ],
            ],

            'full_name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[150]',
                'errors' => [
                    'required' => 'Please enter the full name.',
                ],
            ],

            'role' => [
                'label' => 'Role',
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Please select a role.',
                ],
            ],

            'password' => [
                'label' => 'New Password',
                'rules' => 'permit_empty|min_length[8]|max_length[255]',
                'errors' => [
                    'min_length' => 'The new password must contain at least 8 characters.',
                ],
            ],

            'password_confirm' => [
                'label' => 'Password Confirmation',
                'rules' => 'permit_empty|matches[password]',
                'errors' => [
                    'matches' => 'The passwords do not match.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),

            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),

            'role' => trim(
                (string) $this->request->getPost('role')
            ),
        ];

        $newPassword = (string) $this->request->getPost('password');

        if ($newPassword !== '') {
            $data['password'] = password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );
        }

        $avatar     = $this->request->getFile('avatar');
        $avatarName = $user['avatar'] ?? null;

        if (
            $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE
        ) {
            $avatarRules = [
                'avatar' => [
                    'label' => 'Profile Picture',
                    'rules' => [
                        'uploaded[avatar]',
                        'is_image[avatar]',
                        'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                        'max_size[avatar,2048]',
                    ],
                    'errors' => [
                        'uploaded' => 'Please select a valid image.',
                        'is_image' => 'The uploaded file must be an image.',
                        'mime_in'  => 'Only JPG and PNG images are allowed.',
                        'max_size' => 'The profile picture must not exceed 2 MB.',
                    ],
                ],
            ];

            if (! $this->validate($avatarRules)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $uploadDirectory = FCPATH
                . 'uploads'
                . DIRECTORY_SEPARATOR
                . 'avatars';

            if (! is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $newAvatarName = $avatar->getRandomName();

            $destination = $uploadDirectory
                . DIRECTORY_SEPARATOR
                . $newAvatarName;

            try {
                service('image')
                    ->withFile($avatar->getTempName())
                    ->fit(400, 400, 'center')
                    ->save($destination, 85);

                $oldAvatar = $user['avatar'] ?? null;

                if (! empty($oldAvatar)) {
                    $oldAvatarPath = $uploadDirectory
                        . DIRECTORY_SEPARATOR
                        . basename($oldAvatar);

                    if (is_file($oldAvatarPath)) {
                        unlink($oldAvatarPath);
                    }
                }

                $data['avatar'] = $newAvatarName;
                $avatarName     = $newAvatarName;
            } catch (\Throwable $exception) {
                if (is_file($destination)) {
                    unlink($destination);
                }

                log_message(
                    'error',
                    'Avatar preparation failed: {message}',
                    ['message' => $exception->getMessage()]
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'The profile picture could not be prepared.'
                    );
            }
        }

        $userModel->update($id, $data);

        if ((int) session()->get('user_id') === $id) {
            session()->set([
                'username'  => $data['username'],
                'full_name' => $data['full_name'],
                'role'      => $data['role'],
                'avatar'    => $avatarName,
            ]);
        }

        return redirect()
            ->to('/users')
            ->with(
                'success',
                'The user account was updated successfully.'
            );
    }
}