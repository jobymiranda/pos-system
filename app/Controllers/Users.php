<?php

namespace App\Controllers;

use App\Libraries\MediaStorage;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index(): string
    {
        return $this->render('users/index', [
            'title' => 'Studio Team | CasaForma',
            'users' => (new UserModel())
                ->orderBy('full_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function newForm(): string
    {
        return $this->render('users/form', [
            'title' => 'Add Staff | CasaForma',
            'heading' => 'Add a studio team member',
            'user' => [],
            'formAction' => site_url('users'),
            'submitLabel' => 'Create staff account',
            'creating' => true,
        ]);
    }

    public function create()
    {
        $rules = $this->rules(true);

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $data = $this->userData();
        $data['password'] = password_hash(
            (string) $this->request->getPost('password'),
            PASSWORD_DEFAULT
        );
        $data['created_at'] = date('Y-m-d H:i:s');

        $avatar = $this->request->getFile('avatar');

        if ($this->hasUpload($avatar)) {
            if (! $this->validate($this->avatarRules())) {
                return redirect()->back()->withInput()->with(
                    'errors',
                    $this->validator->getErrors()
                );
            }

            try {
                $data['avatar'] = (new MediaStorage())
                    ->storePreparedImage($avatar, 'avatars', 500, 500);
            } catch (\Throwable $exception) {
                log_message('error', $exception->getMessage());
                return redirect()->back()->withInput()->with(
                    'error',
                    'The avatar could not be prepared.'
                );
            }
        }

        (new UserModel())->insert($data);

        return redirect()->to('/users')->with(
            'success',
            'The staff account was created successfully.'
        );
    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'Staff account not found.'
            );
        }

        return $this->render('users/form', [
            'title' => 'Edit Staff | CasaForma',
            'heading' => 'Update staff details',
            'user' => $user,
            'formAction' => site_url('users/' . $id),
            'submitLabel' => 'Save staff changes',
            'creating' => false,
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'Staff account not found.'
            );
        }

        if (! $this->validate($this->rules(false, $id))) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $data = $this->userData();
        $password = (string) $this->request->getPost('password');

        if ($password !== '') {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($this->hasUpload($avatar)) {
            if (! $this->validate($this->avatarRules())) {
                return redirect()->back()->withInput()->with(
                    'errors',
                    $this->validator->getErrors()
                );
            }

            try {
                $storage = new MediaStorage();
                $data['avatar'] = $storage->storePreparedImage(
                    $avatar,
                    'avatars',
                    500,
                    500
                );
                $storage->deleteLocal($user['avatar'], 'avatars');
            } catch (\Throwable $exception) {
                log_message('error', $exception->getMessage());
                return redirect()->back()->withInput()->with(
                    'error',
                    'The new avatar could not be prepared.'
                );
            }
        }

        $model->update($id, $data);

        if ((int) session()->get('user_id') === $id) {
            session()->set([
                'username' => $data['username'],
                'full_name' => $data['full_name'],
                'role' => $data['role'],
                'avatar' => $data['avatar'] ?? $user['avatar'],
            ]);
        }

        return redirect()->to('/users')->with(
            'success',
            'The staff account was updated successfully.'
        );
    }

    public function archive(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'Staff account not found.'
            );
        }

        if ((int) session()->get('user_id') === $id) {
            return redirect()->to('/users')->with(
                'error',
                'You cannot archive the account currently signed in.'
            );
        }

        if ($user['username'] === 'professor') {
            return redirect()->to('/users')->with(
                'error',
                'The faculty review account is protected.'
            );
        }

        $model->delete($id);

        return redirect()->to('/users')->with(
            'success',
            'The staff account was archived.'
        );
    }

    private function rules(bool $creating, ?int $id = null): array
    {
        $unique = $creating
            ? 'is_unique[users.username]'
            : 'is_unique[users.username,id,' . $id . ']';

        return [
            'username' => 'required|min_length[3]|max_length[50]|'
                . 'alpha_numeric_punct|' . $unique,
            'full_name' => 'required|min_length[2]|max_length[100]',
            'role' => 'required|in_list[Administrator,Manager,Cashier,Staff,Reviewer]',
            'password' => $creating
                ? 'required|min_length[8]|max_length[255]'
                : 'permit_empty|min_length[8]|max_length[255]',
            'password_confirm' => $creating
                ? 'required|matches[password]'
                : 'permit_empty|matches[password]',
        ];
    }

    private function avatarRules(): array
    {
        return [
            'avatar' => [
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'max_size[avatar,2048]',
                ],
            ],
        ];
    }

    private function userData(): array
    {
        return [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'role' => trim((string) $this->request->getPost('role')),
        ];
    }

    private function hasUpload($file): bool
    {
        return $file !== null
            && $file->getError() !== UPLOAD_ERR_NO_FILE;
    }
}