<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesDetailsModel extends Model
{
    protected $table      = 'details_sales';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_sale','id_product', 'detail_qty', 'detail_price'];

    public function getDetalleVentasAll($ventas) {
        $db = \Config\Database::connect();
        $builder = $db->table('details_sales'); //tabla venta
        $builder->select('');
       
        $builder->join('products', 'products.id = details_sales.id_product');
        $query = $builder->where('id_sale', $ventas);
        $query = $builder->get(); 
        return $query->getResultArray();
    }

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [
      
    ];
    
    protected $validationMessages = [
 
    ];
    protected $skipValidation     = false;
}