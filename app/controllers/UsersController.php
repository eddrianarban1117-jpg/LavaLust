<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UsersModel');
    }

    // READ
    public function index()
    {
        $users = $this->UsersModel->all();

        $this->call->view('users', ['users' => $users]);
    }

    // CREATE - Form
    public function create()
    {
        $this->call->view('users_create');
    }

    // CREATE - Save
    public function store()
    {
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname'  => $_POST['lastname'],
            'email'     => $_POST['email'],
            'username'  => $_POST['username']
        ];

        $this->UsersModel->insert($data);

        redirect('/users');
    }

    // UPDATE - Form
    public function edit($id)
    {
        $user = $this->UsersModel->find($id);

        $this->call->view('users_edit', ['user' => $user]);
    }

    // UPDATE - Save
    public function update($id)
    {
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname'  => $_POST['lastname'],
            'email'     => $_POST['email'],
            'username'  => $_POST['username']
        ];

        $this->UsersModel->update($id, $data);

        redirect('/users');
    }

    // DELETE
    public function delete($id)
    {
        $this->UsersModel->delete($id);

        redirect('/users');
    }
}