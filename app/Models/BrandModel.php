<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table      = 'product_brand';
    protected $primaryKey = 'brand_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['brand_desc'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'brand_desc' => 'required|max_length[30]'
    ];
    
    protected $validationMessages = [
        'brand_desc' => [
            'required' => 'Ingrese la marca',
            'max_length' => 'El nombre de la categoria debe tener menos de 30 caracteres'
        ]
    ];
    protected $skipValidation     = false;
}