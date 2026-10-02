<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        $data = [
            'title' => 'Customer Accounts',
            'customers' => $customerModel
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('customers/index', $data)
            . view('templates/footer');
    }

    public function newForm(): string
    {
        $data = [
            'title'       => 'New Customer',
            'formHeading' => 'Create Customer Account',
            'formAction'  => site_url('customers'),
            'submitLabel' => 'Create Customer',
            'customer'    => [],
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('customers/form', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the customer’s full name.',
                ],
            ],
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|max_length[100]|valid_email',
                'errors' => [
                    'required'    => 'Please enter an email address.',
                    'valid_email' => 'Please enter a valid email address.',
                ],
            ],
            'phone' => [
                'label' => 'Phone number',
                'rules' => 'permit_empty|max_length[20]',
            ],
        ];

        $input = [
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'email' => trim(
                (string) $this->request->getPost('email')
            ),
            'phone' => trim(
                (string) $this->request->getPost('phone')
            ),
        ];

        if (! $this->validateData($input, $rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validated = $this->validator->getValidated();

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'full_name' => $validated['full_name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'] !== ''
                ? $validated['phone']
                : null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to(site_url('customers'))
            ->with('success', 'Customer account created successfully.');
    }

    public function edit(int $id): string
    {
        $customerModel = new CustomerModel();
        $customer      = $customerModel->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound(
                'Customer account not found.'
            );
        }

        $data = [
            'title'       => 'Edit Customer',
            'formHeading' => 'Edit Customer Account',
            'formAction'  => site_url("customers/{$id}"),
            'submitLabel' => 'Save Customer Changes',
            'customer'    => $customer,
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('customers/form', $data)
            . view('templates/footer');
    }

    public function update(int $id)
    {
        $customerModel = new CustomerModel();
        $customer      = $customerModel->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound(
                'Customer account not found.'
            );
        }

        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the customer’s full name.',
                ],
            ],
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|max_length[100]|valid_email',
                'errors' => [
                    'required'    => 'Please enter an email address.',
                    'valid_email' => 'Please enter a valid email address.',
                ],
            ],
            'phone' => [
                'label' => 'Phone number',
                'rules' => 'permit_empty|max_length[20]',
            ],
        ];

        $input = [
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'email' => trim(
                (string) $this->request->getPost('email')
            ),
            'phone' => trim(
                (string) $this->request->getPost('phone')
            ),
        ];

        if (! $this->validateData($input, $rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validated = $this->validator->getValidated();

        $customerModel->update($id, [
            'full_name' => $validated['full_name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'] !== ''
                ? $validated['phone']
                : null,
        ]);

        return redirect()
            ->to(site_url('customers'))
            ->with('success', 'Customer account updated successfully.');
    }
}