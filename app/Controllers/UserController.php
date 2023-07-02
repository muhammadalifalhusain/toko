<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->user = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->user->findAll();
        return view('pages/manageUser_view', $data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'user');
        $cekStatus = $this->request->getPost('is_aktif');
        $errors = $this->validation->getErrors();

        $enkrip = $this->request->getPost('password');
        $md5 = md5($enkrip);

        if ($cekStatus == "0") {
            $status = isset($_GET['is_aktif']);
        } else {
            $status = isset($_POST['is_aktif']);
        }

        if (!$errors) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'password' => $md5,
                'is_aktif' => $status
            ];
            $this->user->insert($dataForm);

            return redirect('user')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect('user')->with('failed', implode("<br>", $errors));
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'user');
        $cekStatus = $this->request->getPost('is_aktif');
        $errors = $this->validation->getErrors();
        $enkrip = $this->request->getPost('password');
        $md5 = md5($enkrip);

        if ($cekStatus == "0") {
            $status = isset($_GET['is_aktif']);
        } else {
            $status = isset($_POST['is_aktif']);
        }

        if (!$errors) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'password' => $this->request->getPost('password'),
                'is_aktif' => $status
            ];

            $this->user->update($id, $dataForm);

            return redirect('user')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect('user')->with('failed', implode("", $errors));
        }
    }

    public function delete($id)
    {
        $this->user->delete($id);

        return redirect('user')->with('success', 'Data Berhasil Dihapus');
    }
}
