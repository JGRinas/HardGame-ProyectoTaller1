<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'product_category';
    protected $primaryKey = 'category_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['category_desc'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'category_desc' => 'required|max_length[30]'
    ];
    
    protected $validationMessages = [
        'category_desc' => [
            'required' => 'Ingrese la categoría',
            'max_length' => 'El nombre de la categoria debe tener menos de 30 caracteres'
        ]
    ];
    protected $skipValidation     = false;
}