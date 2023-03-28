<?php

namespace App\Controllers;

use App\Models\HelpModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
class ViewController extends BaseController{
    //inicio
    public function index()
    {
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/templates/slider').view('index').view('/templates/slider-footer').view('/templates/footer');
    }
    //fin inicio
    

    //sesiones
    public function login()
    {
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/sesion/login').view('/templates/footer');
    }

    public function register()
    {
        $infoE = array('infoE'=>'');
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/sesion/register',$infoE).view('/templates/footer');
    }

    public function viewProfile(){
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/sesion/profile').view('/templates/footer');
    }
    //fin sesiones
    

    //otros
    public function aboutUs()
    {
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/various/about-us').view('/templates/footer');
    }

    public function terms()
    {
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/sesion/terms_and_conditions').view('/templates/footer');
    }

    public function help()
    { 
        $infoE = array('infoE' => '');
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/various/help', $infoE).view('/templates/footer');
    }

    public function contact()
    { 
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/various/contact').view('/templates/footer');
    }

    public function marketing()
    {
        $request = \Config\Services::request();
        $productModel = new ProductModel($db);
        $product = $productModel->findAll();
        $product = array('product' => $product);
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/various/marketing', $product).view('/templates/footer');
    }

    //fin otros


    //productos
    public function products()
    {
        $request = \Config\Services::request();
        $productModel = new ProductModel($db);
        $categoryModel = new CategoryModel($db);
        $optionCat=0;
        if($request->getPostGet('id')){
            $optionCat=$request->getPostGet('id');
        }
        

        $category = $categoryModel->findAll();
        $products = $productModel->findAll();
       
        //$products = array('products' =>$products);
        $productsView = array('category' => $category, 'products'=>$products, 'optionCat' => $optionCat);
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/templates/slider').view('/products/products',$productsView).view('/templates/slider-footer').view('/templates/footer');
    }

    public function viewInfoProduct()
    {
        $request = \Config\Services::request();
        $productModel = new ProductModel($db);

        $product = $productModel->where('id', $request->getPostGet('id_producto'))->first();
        $product = array('product' => $product);
        return view('/templates/header').view('/templates/nav1').view('/templates/nav2').view('/products/viewInfoProduct', $product).view('/templates/footer');
    }
}