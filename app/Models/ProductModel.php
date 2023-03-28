<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'brand', 'description', 'stock','price','image','category', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'title' => 'required',
        'brand' => 'required',
        'description' => 'required',
        'stock' => 'required|numeric',
        'price' => 'required|numeric',
        'category' => 'required'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Ingrese el titulo'
        ],
        'brand' => [
            'required' => 'Ingrese la marca'
        ],
        'description' => [
            'required' => 'Ingrese la descripción',
        ],
        'stock' => [
            'required' => 'Ingrese el stock del producto',
            'numeric' => 'El stock debe ser numérico'
        ],
        'price' => [
            'required' => 'Ingrese el precio',
            'numeric' => 'El precio debe ser numérico'
        ],
        'category'=>[
            'required' => 'Escoja la categoría'
        ]

    ];
    protected $skipValidation     = false;
}