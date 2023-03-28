<?php

namespace App\Controllers;

use App\Models\HelpModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\SalesModel;
use App\Models\SalesDetailsModel;

class AdminController extends BaseController
{

    /* PRODUCTOS */

    public function regProductsView()
    {
        $request = \Config\Services::request();
        $productModel = new ProductModel($db);
        $categoryModel = new CategoryModel($db);
        $brandModel = new BrandModel($db);
        $category = $categoryModel->findAll();
        $brand = $brandModel->findAll();
        $product = null;
        if ($request->getPostGet('id')) {
            $idProduct = $request->getPostGet('id');
            $product = $productModel->where('id', $idProduct)->first();
            $data = array('idProduct' => $idProduct, 'product' => $product, 'brand' => $brand, 'category' => $category, 'infoE' => '');

            return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerProducts', $data) . view('/templates/footer');
        } else {
            $data = array('category' => $category, 'brand' => $brand, 'product' => $product, 'infoE' => '');

            return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerProducts', $data) . view('/templates/footer');
        }
    }

    public function regProducts()
    {
        $productModel = new ProductModel($db);
        $categoryModel = new CategoryModel($db);
        $brandModel = new BrandModel($db);
        $category = $categoryModel->findAll();
        $brand = $brandModel->findAll();
        $product = null;
        $request = \Config\Services::request();



        $validatedImage = $this->validate([
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
        ]);

        $img = $request->getFile('image');
        if ($request->getPost('id_product')) {
            if($img->getName() != null){
                
                $img->move(ROOTPATH . 'public/assets/img/uploads/');

                $newProduct = array(
                    'title' => $request->getPost('title'),
                    'brand' => $request->getPost('brand'),
                    'description' => $request->getPost('description'),
                    'stock' => $request->getPost('stock'),
                    'price' => $request->getPost('price'),
                    'image' => $img->getName(),
                    'category' => $request->getPost('category')
                );
                if (!$validatedImage) {
                    $this->session->setFlashdata('imagenError', 'Ingrese una imagen');
                    $this->session->setFlashdata('error2', 'Error. Verifique los campos ingresados');
                    return redirect()->route('registerProducts');
                }
            }else{
                $newProduct = array(
                    'title' => $request->getPost('title'),
                    'brand' => $request->getPost('brand'),
                    'description' => $request->getPost('description'),
                    'stock' => $request->getPost('stock'),
                    'price' => $request->getPost('price'),
                    'category' => $request->getPost('category')
                );
            }

            if ($productModel->update($request->getPost('id_product'), $newProduct)) {

                return redirect()->route('registerProducts');
            } else {
                $data = array('category' => $category, 'brand' => $brand, 'product' => $product, 'infoE' => $productModel->errors());

                return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerProducts', $data) . view('/templates/footer');
            }
        } else {

            if (!$validatedImage) {
                $this->session->setFlashdata('imagenError', 'Ingrese una imagen');
                $this->session->setFlashdata('error2', 'Error. Verifique los campos ingresados');
                return redirect()->route('registerProducts');
            }

            $img = $request->getFile('image');

            $img->move(ROOTPATH . 'public/assets/img/uploads/');
    
            $newProduct = array(
                'title' => $request->getPost('title'),
                'brand' => $request->getPost('brand'),
                'description' => $request->getPost('description'),
                'stock' => $request->getPost('stock'),
                'price' => $request->getPost('price'),
                'image' => $img->getName(),
                'category' => $request->getPost('category')
            );

            if ($productModel->insert($newProduct)) {
                return redirect()->route('registerProducts');
            } else {

                $this->session->setFlashdata('imagenError', 'Ingrese una imagen');
                $data = array('category' => $category, 'brand' => $brand, 'product' => $product, 'infoE' => $productModel->errors());

                return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerProducts', $data) . view('/templates/footer');
            }
        }
    }

    public function regCategory()
    {
        $categoryModel = new CategoryModel($db);
        $request = \Config\Services::request();

        $newData = array(
            'category_desc' => $request->getPost('category_desc')
        );

        if ($categoryModel->insert($newData)) {
            $this->session->setFlashdata('insertInfo', 'Categoría guardada');
            return redirect()->route('registerCategory');
        } else {
            $this->session->setFlashdata('insertInfo', implode("<br>", $categoryModel->errors()));
            return redirect()->route('registerCategory');
        }
    }

    public function regCategoryView()
    {
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerCategory') . view('/templates/footer');
    }

    public function regBrand()
    {
        $brandModel = new BrandModel($db);
        $request = \Config\Services::request();

        $newData = array(
            'brand_desc' => $request->getPost('brand_desc')
        );

        if ($brandModel->insert($newData)) {
            $this->session->setFlashdata('insertInfo', 'Marca guardada');
            return redirect()->route('registerBrand');
        } else {
            $this->session->setFlashdata('insertInfo', implode("<br>", $brandModel->errors()));
            return redirect()->route('registerBrand');
        }
    }

    public function regBrandView()
    {
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/registerBrand') . view('/templates/footer');
    }


    public function viewManageProducts()
    {
        $categoryModel = new CategoryModel($db);
        $brandModel = new BrandModel($db);
        $productModel = new ProductModel($db);

        $products = $productModel->withDeleted()->paginate(10);
        $paginador = $productModel->pager;
        $brand = $brandModel->findAll(); 
        $category =  $categoryModel->findAll();
        $products = array('products' => $products, 'paginador' => $paginador, 'category' => $category, 'brand' => $brand);

        
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/manageProducts', $products) . view('/templates/footer');
    }

    public function deleteProduct()
    {
        $productModel = new ProductModel($db);
        $request = \Config\Services::request();
        $product = $request->getPostGet('id');
        if ($product) {
            $productModel->delete($product);
            return redirect()->route('manageProducts');
        } else {
            $this->session->setFlashdata('deleteProductError', 'No se pudo eliminar el producto');

            return redirect()->route('manageProducts');
        }
    }



    public function restoreProduct()
    {
        $productModel = new ProductModel($db);
        $request = \Config\Services::request();
        $product = $request->getPostGet('id');
        if ($product) {
            $restore = [
                'deleted_at' => null
            ];
            $productModel->update($product, $restore);
            return redirect()->route('manageProducts');
        } else {
            $this->session->setFlashdata('deleteProductError', 'No se pudo restaurar el producto');

            return redirect()->route('manageProducts');
        }
    }




    /* FIN DE PRODUCTOS */



    /* CONSULTAS */

    public function viewConsults()
    {
        $consultModel = new HelpModel($db);

        $users = $consultModel->withDeleted()->paginate(10);
        $paginador = $consultModel->pager;

        $users = array('users' => $users, 'paginador' => $paginador);

        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/consults', $users) . view('/templates/footer');
    }

    public function deleteConsult()
    {
        $consultModel = new HelpModel($db);
        $request = \Config\Services::request();

        if ($request->getPostGet('id_message')) {
            $consultModel->delete($request->getPostGet('id_message'));
            return redirect()->route('consults');
        } else {
            $this->session->setFlashdata('deleteConsultError', 'No se pudo eliminar la consulta');

            return redirect()->route('consults');
        }
    }

    public function restoreConsult()
    {
        $consultModel = new HelpModel($db);
        $request = \Config\Services::request();

        if ($request->getPostGet('id_message')) {

            $dataRestore = [
                'deleted_at' => NULL
            ];

            $consultModel->update($request->getPostGet('id_message'), $dataRestore);
            return redirect()->route('consults');
        } else {

            $this->session->setFlashdata('deleteConsultError', 'No se pudo eliminar la consulta');
            return redirect()->route('consults');
        }
    }

    public function consultAnswer()
    {
        $consultModel = new HelpModel($db);
        $request = \Config\Services::request();
        $consult = $consultModel->where('id_message', $request->getPostGet('id_message'))->find();
        $idMessage = $request->getPostGet('id_message');
        $data = array('consult' => $consult, 'idMessage' => $idMessage);

        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/consultAnswer', $data) . view('/templates/footer');
    }

    public function consultAnswerReg()
    {
        $consultModel = new HelpModel($db);
        $request = \Config\Services::request();

        $answer = [
            'answer' => $request->getPost('answer')
        ];

        $consultModel->update($request->getPostGet('id_message'), $answer);
        return redirect()->route('consults');
    }

    /* FIN DE CONSULTAS */


    /*USUARIOS */

    public function viewManageUsers()
    {
        $userModel = new UserModel($db);

        $users = $userModel->withDeleted()->paginate(10);
        $paginador = $userModel->pager;
        $users = array('users' => $users, 'paginador' => $paginador);

        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/manageUsers', $users) . view('/templates/footer');
    }


    public function deleteUser()
    {
        $userModel = new UserModel($db);
        $request = \Config\Services::request();
        $user = $request->getPostGet('id');
        if ($user) {
            $userModel->delete($request->getPostGet('id'));
            return redirect()->route('manageUsers');
        } else {
            $this->session->setFlashdata('deleteUserError', 'No se pudo eliminar el usuario');

            return redirect()->route('manageUsers');
        }
    }

    public function restoreUser()
    {
        $userModel = new UserModel($db);
        $request = \Config\Services::request();

        $restore = [
            'deleted_at' => null
        ];

        $userModel->update($request->getPostGet('id'), $restore);

        return redirect()->route('manageUsers');
    }

    public function getVentasAll() {
        $db = \Config\Database::connect(); //conecta a la base de datos
        $builder = $db->table('sales'); //tabla venta
        $builder->select('');
        //obtiene la relacion entre  las tablas (trae todos los campos)
        $builder->join('users', 'users.id = sales.id_user');
    
        $query = $builder->get(); //guarda
        return $query->getResultArray(); //retorna un array
    }

    public function manageSales(){
        $salesModel = new SalesModel($db);
        $sales = $salesModel->getVentasAll();
        $paginador = $salesModel->pager;
        $sales = array('sales' => $sales, 'paginador' => $paginador);
        
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/manageSales', $sales) . view('/templates/footer');

    }

    public function getDetalleVentasAll($ventas) {
        $db = \Config\Database::connect(); //conecta a la base de datos
        $builder = $db->table('details_sales'); //tabla venta
        $builder->select('');
        //obtiene la relacion entre  las tablas (trae todos los campos)
        $builder->join('products', 'products.id = details_sales.id_product');
        $query = $builder->where('id_sale', $ventas);
        $query = $builder->get(); //guarda
        return $query->getResultArray(); //retorna un array
    }

    public function viewSaleDetails(){
        $salesModel = new SalesDetailsModel($db);
        $request= \Config\Services::request();

        $sales = $salesModel->getDetalleVentasAll($request->getPostGet('id_sale'));
        
        $sales = array('sales' => $sales);
        
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/admin/viewSaleDetails', $sales) . view('/templates/footer');

    }
}

