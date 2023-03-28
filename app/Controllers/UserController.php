<?php

namespace App\Controllers;

use App\Models\HelpModel;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\SalesModel;
use App\Models\SalesDetailsModel;
use App\Models\ProductModel;

class UserController extends BaseController
{

    public function registerHelp()
    {
        $helpModel = new HelpModel($db);
        $request = \Config\Services::request();
        $newConsult = array(
            'name' => session('name') . ' ' . session('surname'),
            'email' => session('email'),
            'theme' => $request->getPostGet('theme'),
            'consult' => $request->getPostGet('consult')
        );
        if ($helpModel->insert($newConsult) === false) {
            $infoE = array('infoE' => $helpModel->errors());

            return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/various/help', $infoE) . view('/templates/footer');
        } else {
            return redirect()->route('help');
        }
    }

    public function consultSend()
    {
        $consultModel = new HelpModel($db);
        $consults = $consultModel->where('email', session('email'))->findAll();
        $consults = array('consults' => $consults);

        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/various/consultSend', $consults) . view('/templates/footer');
    }

    public function loginUser()
    {
        $userModel = new UserModel();
        $request = \Config\Services::request();

        $emailL = $request->getPost('emailL');
        $passL = $request->getPost('passL');
        $user = $userModel->where('email', $emailL)->first();

        if ($user && password_verify($passL, $user['pass'])) {

            $data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'username' => $user['username'],
                'email' => $user['email'],
                'profile' => $user['id_profile'],
                'photo_p' => $user['photo_profile'],
                'login' => TRUE
            ];

            $this->session->set($data);
            return redirect()->route('index');
        } else {
            $this->session->setFlashdata('loginError', 'Usuario o contraseña incorrecto');

            return redirect()->route('login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->route('login');
    }

    public function registerUser()
    {
        $userModel = new UserModel($db);
        $request = \Config\Services::request();

        $newData = array(
            'name' => $request->getPost('name'),
            'surname' => $request->getPost('surname'),
            'email' => $request->getPost('email'),
            'username' => $request->getPost('username'),
            'accept_terms' => $request->getPost('accept_terms'),
            'passR' => $request->getPost('passR'),
            'pass' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT)
        );

        $passVerify = password_verify($newData['passR'], $newData['pass']);
        if ($userModel->insert($newData) && $passVerify) {

            $user = $userModel->where('email', $newData['email'])->first();

            $data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'username' => $user['username'],
                'email' => $user['email'],
                'profile' => $user['id_profile'],
                'photo_p' => $user['photo_profile'],
                'login' => TRUE
            ];

            $this->session->set($data);

            return redirect()->route('index');
        } else {

            $infoE = array('infoE' => $userModel->errors());

            if ($passVerify === false) {
                $this->session->setFlashdata('regError2', 'Confirmación de contraseña incorrecta');
            }

            return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/sesion/register', $infoE) . view('/templates/footer');
        }
    }

    public function editProfile()
    {
        $userModel = new UserModel($db);
        $request = \Config\Services::request();

        //segmento
        if ($request->getPostGet('id')) {
            $option = $request->getPostGet('id');
        } else {
            $option = $request->uri->getSegment(3);
        }

        $user = $userModel->where('id', session('id'))->first();
        $info = array('option' => $option, 'user' => $user);
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/sesion/formEditProfile', $info) . view('/templates/footer');
    }

    public function updateProfile()
    {
        $userModel = new UserModel($db);
        $request = \Config\Services::request();

        $user = $userModel->where('email', session('email'))->first();
        $img = $request->getFile('image');
        if (password_verify($request->getPostGet('passC'), $user['pass'])) {

            if ($request->getPostGet('name') && $request->getPostGet('email')) {

                $data = array(
                    'name' => $request->getPostGet('name'),
                    'surname' => $request->getPostGet('surname')
                );
            } else if ($img->getName() != null) {

                $validatedImage = $this->validate(
                    [
                        'image' => [
                            'uploaded[image]',
                            'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        ],
                    ],
                    [
                        'image' => [
                            'uploaded' => 'Ingrese una imagen',
                            'mime_in' => 'Debe ingresar una imagen (jpg, jpeg, gif, png o webp)'
                        ],
                    ]
                );

                if (!$validatedImage) {
                    $this->session->setFlashdata('editError', 'ERROR: Ingrese una imagen');
                    return redirect()->route('profile');
                }

                $img->move(ROOTPATH . 'public/assets/img/photoProfile/');

                $data = array(
                    'photo_profile' => $img->getName()
                );
            } else if ($request->getPostGet('email')) {

                $data = array(
                    'email' => $request->getPostGet('email'),
                );
            } else if ($request->getPostGet('username')) {

                $data = array(
                    'username' => $request->getPostGet('username'),
                );
            } else {
                ($request->getPostGet('passR') && $request->getPostGet('pass'));

                $data = array(
                    'pass' => password_hash($request->getPostGet('pass'), PASSWORD_BCRYPT),
                    'passR' => $request->getPostGet('passR')
                );
                if (password_verify($data['passR'], $data['pass']) === false) {
                    $this->session->setFlashdata('editError', 'Verificacion de contraseña incorrecta');
                    return redirect()->route('profile');
                }
            }

            $data['id'] = $userModel->find(session('id'));

            if ($userModel->save($data) === false) {

                $this->session->setFlashdata('editError', 'Campo o contraseña incorrectos');
                return redirect()->route('profile');
            } else {

                return redirect()->route('profile');
            }
        } else {

            $this->session->setFlashdata('editError', 'Campo o contraseña incorrectos');
            return redirect()->route('profile');
        }
    }
    public function getVentasUser($idUser)
    {
        $db = \Config\Database::connect(); //conecta a la base de datos
        $builder = $db->table('sales'); //tabla venta
        $builder->select('');
        //obtiene la relacion entre  las tablas (trae todos los campos)
        $builder->join('users', 'users.id = sales.id_user');
        $query = $builder->where('id', $idUser);
        $query = $builder->get(); //guarda
        return $query->getResultArray(); //retorna un array
    }

    function myPurchases()
    {
        $salesDetailModel = new SalesDetailsModel($db);
        $salesModel = new SalesModel($db);
        $productModel = new ProductModel($db);

        $sales = $salesModel->getVentasUser(session('id'));

        $sales = array('sales' => $sales);
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/sesion/myPurchases', $sales) . view('/templates/footer');
    }

    public function getDetalleVentasAll($ventas)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('details_sales'); //tabla venta
        $builder->select('');

        $builder->join('products', 'products.id = details_sales.id_product');
        $query = $builder->where('id_sale', $ventas);
        $query = $builder->get();
        return $query->getResultArray();
    }

    function downloadPdfSale()
    {
        $salesModel = new SalesDetailsModel($db);
        $request = \Config\Services::request();

        $purchases = $salesModel->getDetalleVentasAll($request->getPostGet('id_sale'));

        $purchases = array('purchases' => $purchases);
        return view('products/downloadPdfSale', $purchases);
    }
}
