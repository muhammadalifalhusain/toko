<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\UserModel;

class Page extends BaseController
{
    public function keranjang()
    {
        return view('pages/keranjang_view');
    }
    public function registrasi()
    {
        return view('pages/registrasi_view');
    }

    public function produk()
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->findAll();
        $data['produks'] = $produk;

        return view('pages/produk_view', $data);
    }
    public function manageUser()
    {
        $userModel = new UserModel();
        $user = $userModel->findAll();
        $data['users'] = $user;

        return view('pages/manageUser_view', $data);
    }
}
