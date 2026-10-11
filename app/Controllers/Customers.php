<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index(): string
    {
        return $this->render('customers/index', [
            'title' => 'Clients | CasaForma',
            'customers' => (new CustomerModel())
                ->orderBy('full_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function newForm(): string
    {
        return $this->render('customers/form', [
            'title' => 'Add Client | CasaForma',
            'heading' => 'Welcome a new client',
            'customer' => [],
            'formAction' => site_url('customers'),
            'submitLabel' => 'Create client record',
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $data = $this->customerData();
        $data['created_at'] = date('Y-m-d H:i:s');
        (new CustomerModel())->insert($data);

        return redirect()->to('/customers')->with(
            'success',
            'The client record was created successfully.'
        );
    }

    public function edit(int $id): string
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound(
                'Client record not found.'
            );
        }

        return $this->render('customers/form', [
            'title' => 'Edit Client | CasaForma',
            'heading' => 'Update client details',
            'customer' => $customer,
            'formAction' => site_url('customers/' . $id),
            'submitLabel' => 'Save client changes',
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();

        if ($model->find($id) === null) {
            throw PageNotFoundException::forPageNotFound(
                'Client record not found.'
            );
        }

        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $model->update($id, $this->customerData());

        return redirect()->to('/customers')->with(
            'success',
            'The client record was updated successfully.'
        );
    }

    public function delete(int $id)
    {
        $model = new CustomerModel();

        if ($model->find($id) === null) {
            throw PageNotFoundException::forPageNotFound(
                'Client record not found.'
            );
        }

        $model->delete($id);

        return redirect()->to('/customers')->with(
            'success',
            'The client record was removed from active accounts.'
        );
    }

    private function rules(): array
    {
        return [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];
    }

    private function customerData(): array
    {
        $phone = trim((string) $this->request->getPost('phone'));

        return [
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => $phone !== '' ? $phone : null,
        ];
    }
}