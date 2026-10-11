<?php

namespace App\Controllers;

use App\Libraries\MediaStorage;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Products extends BaseController
{
    public function index(): string
    {
        $category = trim((string) $this->request->getGet('category'));
        $search = trim((string) $this->request->getGet('q'));

        if (! in_array($category, ProductModel::CATEGORIES, true)) {
            $category = '';
        }

        $model = new ProductModel();
        $builder = $model->orderBy('created_at', 'DESC');

        if ($category !== '') {
            $builder->where('category', $category);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('sku', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        return $this->render('products/index', [
            'title' => 'Furniture Collection | CasaForma',
            'products' => $builder->findAll(),
            'categories' => ProductModel::CATEGORIES,
            'categoryCounts' => $model->categoryCounts(),
            'selectedCategory' => $category,
            'search' => $search,
            'totalProducts' => $model->countAllResults(),
        ]);
    }

    public function newForm(): string
    {
        return $this->renderForm([], 'Add a showroom piece', site_url('products'), 'Add to collection');
    }

    public function create()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->productData();
        $image = $this->request->getFile('image');

        if ($this->hasUpload($image)) {
            if (! $this->validate($this->imageRules())) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            try {
                $data['image'] = (new MediaStorage())->storePreparedImage($image, 'products', 1000, 760);
            } catch (\Throwable $exception) {
                log_message('error', $exception->getMessage());
                return redirect()->back()->withInput()->with('error', 'The product image could not be prepared.');
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        (new ProductModel())->insert($data);

        return redirect()->to('/products')->with('success', 'The furniture item was added to the collection.');
    }

    public function edit(int $id): string
    {
        $product = (new ProductModel())->find($id);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound('Furniture item not found.');
        }

        return $this->renderForm($product, 'Refine product details', site_url('products/' . $id), 'Save product changes');
    }

    public function update(int $id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound('Furniture item not found.');
        }

        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->productData();
        $image = $this->request->getFile('image');

        if ($this->hasUpload($image)) {
            if (! $this->validate($this->imageRules())) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            try {
                $storage = new MediaStorage();
                $data['image'] = $storage->storePreparedImage($image, 'products', 1000, 760);
                $storage->deleteLocal($product['image'], 'products');
            } catch (\Throwable $exception) {
                log_message('error', $exception->getMessage());
                return redirect()->back()->withInput()->with('error', 'The new product image could not be prepared.');
            }
        }

        $model->update($id, $data);

        return redirect()->to('/products')->with('success', 'The furniture item was updated successfully.');
    }

    public function archive(int $id)
    {
        $model = new ProductModel();

        if ($model->find($id) === null) {
            throw PageNotFoundException::forPageNotFound('Furniture item not found.');
        }

        $model->delete($id);

        return redirect()->to('/products')->with('success', 'The furniture item was archived.');
    }

    private function renderForm(array $product, string $heading, string $formAction, string $submitLabel): string
    {
        return $this->render('products/form', [
            'title' => ($product === [] ? 'Add Furniture' : 'Edit Furniture') . ' | CasaForma',
            'heading' => $heading,
            'product' => $product,
            'categories' => ProductModel::CATEGORIES,
            'formAction' => $formAction,
            'submitLabel' => $submitLabel,
        ]);
    }

    private function rules(): array
    {
        return [
            'sku' => 'permit_empty|max_length[30]|alpha_numeric_punct',
            'name' => 'required|min_length[2]|max_length[100]',
            'category' => 'required|in_list[Sofa & Seating,Tables & Dining,Bedroom,Lighting,Storage,Decor & Accents]',
            'price' => 'required|decimal|greater_than[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
            'description' => 'permit_empty|max_length[1000]',
        ];
    }

    private function imageRules(): array
    {
        return [
            'image' => [
                'rules' => ['uploaded[image]', 'is_image[image]', 'mime_in[image,image/jpg,image/jpeg,image/png]', 'max_size[image,2048]'],
                'errors' => [
                    'is_image' => 'The product file must be an image.',
                    'mime_in' => 'Only JPG and PNG images are allowed.',
                    'max_size' => 'The product image must not exceed 2 MB.',
                ],
            ],
        ];
    }

    private function productData(): array
    {
        $sku = trim((string) $this->request->getPost('sku'));
        $description = trim((string) $this->request->getPost('description'));

        return [
            'sku' => $sku !== '' ? strtoupper($sku) : null,
            'name' => trim((string) $this->request->getPost('name')),
            'category' => trim((string) $this->request->getPost('category')),
            'price' => number_format((float) $this->request->getPost('price'), 2, '.', ''),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
            'description' => $description !== '' ? $description : null,
        ];
    }

    private function hasUpload($file): bool
    {
        return $file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE;
    }
}