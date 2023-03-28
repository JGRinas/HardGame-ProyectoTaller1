<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesDetailsModel;
use App\Models\ProductModel;
class CartController extends BaseController{

    function addToCart(){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $cart->insert(array(
            'id'      => $request->getPost('id'),
            'qty'     => 1,
            'price'   => $request->getPost('price'),
            'name'    => $request->getPost('title'),
         ));

        return redirect()->route('products');
    }

    function removeToCart(){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $cart->remove($request->getPostGet('rowid'));
        
        return redirect()->route('cartView');
    }

    function cartDestroy(){
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->route('products');
    }

    function cartView(){
        $cart = \Config\Services::cart();
        $cart = array('cart' => $cart); 
        return view('/templates/header') . view('/templates/nav1') . view('/templates/nav2') . view('/products/cartView', $cart) . view('/templates/footer');
    }

    function newPurchases(){
        $salesDetailModel = new SalesDetailsModel($db);
        $salesModel = new SalesModel($db);
        $productModel = new ProductModel($db);
        $cart = \Config\Services::cart();
        
        $newSale=[
            'id_user' => session('id'),
        ];
        
        foreach($cart->contents() as $car){
            $idProductos[] = $car["id"];
            $carRows[] = $car["rowid"];
        }
        $productos = $productModel->find($idProductos);

        for($i=0; $i<sizeof($productos); $i++){
            if($productos[$i]["stock"] < $cart->getItem($carRows[$i])["qty"] ){
                $this->session->setFlashdata('stockError', 'Lo sentimos. El producto '. $productos[$i]["title"]. ' no tiene suficiente stock ');
                $cart = \Config\Services::cart();
                $cart->destroy();
                return redirect()->route('cartView');
            }
        }

        $id_sale = $salesModel->insert($newSale);

        for($i=0; $i<sizeof($productos); $i++){
            $salesDetailModel->insert([
                'id_sale' => $id_sale,
                'id_product' => $productos[$i]["id"],
                'detail_qty' => $cart->getItem($carRows[$i])["qty"],
                'detail_price' => $productos[$i]["price"]*$cart->getItem($carRows[$i])["qty"],
            ]);
            $productModel->update($productos[$i]["id"], [
                "stock" => $productos[$i]["stock"] - $cart->getItem($carRows[$i])["qty"]
            ]);
        }

        return redirect()->route('cartDestroy');
    }



 
}



?>