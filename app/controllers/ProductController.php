<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->model('ProductModel');
    }

    // =========================
    // READ - Product List
    // =========================
    public function index()
    {
        $products = $this->ProductModel->all();

        $this->call->view('products/index', [
            'products' => $products
        ]);
    }


    // =========================
    // CREATE - Show Form
    // =========================
    public function create()
    {
        $this->call->view('products/create');
    }


    // =========================
    // CREATE - Save Product
    // =========================
    public function store()
    {
        $data = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        ];

        $this->ProductModel->insert($data);

        redirect(site_url('products'));
    }


    // =========================
    // UPDATE - Show Edit Form
    // =========================
    public function edit($id)
    {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            redirect(site_url('products'));
            return;
        }

        $this->call->view('products/edit', [
            'product' => $product
        ]);
    }


    // =========================
    // UPDATE - Save Changes
    // =========================
    public function update($id)
    {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            redirect(site_url('products'));
            return;
        }

        $data = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        ];

        $this->ProductModel->update($id, $data);

        redirect(site_url('products'));
    }


    // =========================
    // DELETE - Remove Product
    // =========================
    public function delete($id)
    {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            redirect(site_url('products'));
            return;
        }

        $this->ProductModel->delete($id);

        redirect(site_url('products'));
    }
}
?>