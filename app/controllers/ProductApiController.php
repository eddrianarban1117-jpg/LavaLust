<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('api');
        $this->call->model('ProductModel');
    }

    private function authenticate()
    {
        $this->api->require_jwt();
    }

    public function index()
    {
        $this->api->require_method('GET');
        $this->authenticate();

        $products = $this->ProductModel->all();

        $this->api->respond([
            'status' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $products
        ]);
    }

    public function show($id)
    {
        $this->api->require_method('GET');
        $this->authenticate();

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
            return;
        }

        $this->api->respond([
            'status' => true,
            'message' => 'Product retrieved successfully.',
            'data' => $product
        ]);
    }

    public function store()
    {
        $this->api->require_method('POST');
        $this->authenticate();

        $input = $this->api->body();

        $data = [
            'product_name' => trim($input['product_name'] ?? ''),
            'description'  => trim($input['description'] ?? ''),
            'price'        => $input['price'] ?? 0,
            'quantity'     => $input['quantity'] ?? 0
        ];

        if ($data['product_name'] === '') {
            $this->api->respond_error(
                'Product name is required.',
                400
            );

            return;
        }

        $this->ProductModel->insert($data);

        $this->api->respond([
            'status' => true,
            'message' => 'Product created successfully.',
            'data' => $data
        ], 201);
    }

    public function update($id)
    {
        $this->api->require_method('PUT');
        $this->authenticate();

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error(
                'Product not found.',
                404
            );

            return;
        }

        $input = $this->api->body();

        $data = [
            'product_name' => trim($input['product_name'] ?? ''),
            'description'  => trim($input['description'] ?? ''),
            'price'        => $input['price'] ?? 0,
            'quantity'     => $input['quantity'] ?? 0
        ];

        if ($data['product_name'] === '') {
            $this->api->respond_error(
                'Product name is required.',
                400
            );

            return;
        }

        $this->ProductModel->update($id, $data);

        $this->api->respond([
            'status' => true,
            'message' => 'Product updated successfully.',
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        $this->api->require_method('DELETE');
        $this->authenticate();

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error(
                'Product not found.',
                404
            );

            return;
        }

        $this->ProductModel->delete($id);

        $this->api->respond([
            'status' => true,
            'message' => 'Product deleted successfully.',
            'data' => null
        ]);
    }
}
?>