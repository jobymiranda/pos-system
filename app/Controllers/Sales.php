<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Sales extends BaseController
{
    public function index(): string
    {
        return $this->render('sales/index', [
            'title' => 'Sales History | CasaForma',
            'sales' => (new SaleModel())->getHistory(),
        ]);
    }

    public function newForm(): string
    {
        return $this->render('sales/new', [
            'title' => 'Record Sale | CasaForma',
            'products' => (new ProductModel())
                ->where('stock_quantity >', 0)
                ->orderBy('name', 'ASC')
                ->findAll(),
            'customers' => (new CustomerModel())
                ->orderBy('full_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id' => 'required|integer|is_not_unique[products.id]',
            'customer_id' => 'permit_empty|integer|is_not_unique[customers.id]',
            'quantity' => 'required|integer|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        }

        $productId = (int) $this->request->getPost('product_id');
        $quantity = (int) $this->request->getPost('quantity');
        $customerInput = trim(
            (string) $this->request->getPost('customer_id')
        );
        $customerId = $customerInput === ''
            ? null
            : (int) $customerInput;

        $db = db_connect();
        $db->transBegin();

        try {
            $product = $db->query(
                'SELECT id, name, price, stock_quantity '
                . 'FROM products '
                . 'WHERE id = ? AND deleted_at IS NULL '
                . 'FOR UPDATE',
                [$productId]
            )->getRowArray();

            if ($product === null) {
                throw new \RuntimeException(
                    'The selected furniture item is unavailable.'
                );
            }

            if ($quantity > (int) $product['stock_quantity']) {
                $db->transRollback();

                return redirect()->back()->withInput()->with(
                    'error',
                    'Only '
                    . $product['stock_quantity']
                    . ' unit(s) of '
                    . $product['name']
                    . ' are available.'
                );
            }

            $total = round((float) $product['price'] * $quantity, 2);

            $saleModel = new SaleModel();
            $saleId = $saleModel->insert([
                'product_id' => $productId,
                'customer_id' => $customerId,
                'sold_by' => (int) session()->get('user_id'),
                'quantity' => $quantity,
                'total_price' => number_format($total, 2, '.', ''),
                'created_at' => date('Y-m-d H:i:s'),
            ], true);

            $db->table('products')
                ->where('id', $productId)
                ->set(
                    'stock_quantity',
                    'stock_quantity - ' . $quantity,
                    false
                )
                ->update();

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'The transaction could not be completed.'
                );
            }

            $db->transCommit();

            return redirect()
                ->to('/sales/' . $saleId . '/receipt')
                ->with('success', 'Sale recorded successfully.');
        } catch (\Throwable $exception) {
            $db->transRollback();

            log_message('error', $exception->getMessage());

            return redirect()->back()->withInput()->with(
                'error',
                $exception->getMessage()
            );
        }
    }

    public function receipt(int $id): string
    {
        $sale = (new SaleModel())->getReceipt($id);

        if ($sale === null) {
            throw PageNotFoundException::forPageNotFound(
                'Sale receipt not found.'
            );
        }

        return $this->render('sales/receipt', [
            'title' => 'Receipt #' . $id . ' | CasaForma',
            'sale' => $sale,
        ]);
    }
}