<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'User Accounts',
            'users' => $userModel
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('users/index', $data)
            . view('templates/footer');
    }

    public function newForm(): string
    {
        $data = [
            'title'       => 'New User',
            'formHeading' => 'Create User Account',
            'formAction'  => site_url('users'),
            'submitLabel' => 'Create User',
            'user'        => [],
            'allowAvatar' => false,
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('users/form', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|max_length[50]'
                    . '|is_unique[users.username]',
                'errors' => [
                    'required'  => 'Please enter a username.',
                    'is_unique' => 'That username is already in use.',
                ],
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the user’s full name.',
                ],
            ],
        ];

        $input = [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
        ];

        if (! $this->validateData($input, $rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validated = $this->validator->getValidated();

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $validated['username'],
            'full_name'  => $validated['full_name'],
            'avatar'     => null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to(site_url('users'))
            ->with('success', 'User account created successfully.');
    }

    public function edit(int $id): string
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User account not found.'
            );
        }

        $data = [
            'title'       => 'Edit User',
            'formHeading' => 'Edit User Account',
            'formAction'  => site_url("users/{$id}"),
            'submitLabel' => 'Save User Changes',
            'user'        => $user,
            'allowAvatar' => true,
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('users/form', $data)
            . view('templates/footer');
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User account not found.'
            );
        }

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|max_length[50]'
                    . "|is_unique[users.username,id,{$id}]",
                'errors' => [
                    'required'  => 'Please enter a username.',
                    'is_unique' => 'That username is already in use.',
                ],
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the user’s full name.',
                ],
            ],
        ];

        $avatar = $this->request->getFile('avatar');

        $avatarWasSubmitted = $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($avatarWasSubmitted) {
            $rules['avatar'] = [
                'label' => 'Profile picture',
                'rules' => [
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'ext_in[avatar,jpg,jpeg,png]',
                    'max_size[avatar,2048]',
                    'max_dims[avatar,5000,5000]',
                ],
                'errors' => [
                    'is_image' => 'The profile picture must be an image.',
                    'mime_in'  => 'Only JPG and PNG images are allowed.',
                    'ext_in'   => 'Only JPG and PNG files are allowed.',
                    'max_size' => 'The profile picture must not exceed 2 MB.',
                    'max_dims' => 'The image dimensions are too large.',
                ],
            ];
        }

        $input = [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
        ];

        if (! $this->validateData($input, $rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validated = $this->validator->getValidated();

        $updateData = [
            'username'  => $validated['username'],
            'full_name' => $validated['full_name'],
        ];

        $newAvatarFilename = null;

        if ($avatarWasSubmitted) {
            if (
                ! $avatar->isValid()
                || $avatar->hasMoved()
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'The uploaded image could not be processed.',
                    ]);
            }

            $extension = $avatar->guessExtension();

            if (! in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'Only JPG and PNG images are allowed.',
                    ]);
            }

            $uploadDirectory = FCPATH
                . 'uploads'
                . DIRECTORY_SEPARATOR
                . 'avatars';

            if (! is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0775, true);
            }

            $newAvatarFilename = bin2hex(random_bytes(16))
                . '.'
                . $extension;

            $destination = $uploadDirectory
                . DIRECTORY_SEPARATOR
                . $newAvatarFilename;

            try {
                service('image')
                    ->withFile($avatar->getTempName())
                    ->fit(300, 300, 'center')
                    ->save($destination, 85);
            } catch (\Throwable $exception) {
                log_message(
                    'error',
                    'Avatar processing failed: {message}',
                    ['message' => $exception->getMessage()]
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'The uploaded image could not be prepared.',
                    ]);
            }

            $updateData['avatar'] = $newAvatarFilename;
        }

        $userModel->update($id, $updateData);

        if (
            $newAvatarFilename !== null
            && ! empty($user['avatar'])
        ) {
            $oldAvatar = FCPATH
                . 'uploads'
                . DIRECTORY_SEPARATOR
                . 'avatars'
                . DIRECTORY_SEPARATOR
                . basename($user['avatar']);

            if (is_file($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        return redirect()
            ->to(site_url('users'))
            ->with('success', 'User account updated successfully.');
    }
}