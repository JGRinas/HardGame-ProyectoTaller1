<?php

namespace App\Models;

use CodeIgniter\Model;

class HelpModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id_message';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'theme','consult','answer', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'theme' => 'required|max_length[20]',
        'consult' => 'required',
    ];
    
    protected $validationMessages = [
        'theme' => [
            'required' => 'Ingrese el tema de discusión de usuario',
            'max_length' => 'El tema de discusión debe tener menos de 20 caracteres'
        ],
        'consult' => [
            'required' => 'Ingrese su consulta',
        ]
    ];
    protected $skipValidation     = false;
}