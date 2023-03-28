<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'surname', 'email', 'username','pass','photo_profile','deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'username' => 'required|is_unique[users.username]',
        'pass' => 'required|min_length[6]',
        'passR' => 'required',
        'accept_terms' => 'required',
        
    ];
    
    protected $validationMessages = [
        'name' => [
            'required' => 'Ingrese su nombre'
        ],
        'surname' => [
            'required' => 'Ingrese su apellido'
        ],
        'email' => [
            'required' => 'Ingrese su email',
            'valid_email' => 'Ingrese un Email válido',
            'is_unique' => 'Email ya registrado'
        ],
        'username' => [
            'required' => 'Ingrese su nombre de usuario',
            'is_unique' => 'Usuario ya registrado'
        ],
        'pass' => [
            'required' => 'Ingrese una contraseña',
            'min_length' => 'La contraseña debe tener como mínimo 6 caracteres'
        ],
        'passR' => [
            'required' => 'Ingrese la confirmación de su contraseña',
            'matches' => 'la confirmación de la contraseña debe ser igual a la contraseña ingresada'
        ],
        'accept_terms'=>[
            'required' => 'Debes aceptar los términos y condiciones de uso.'
        ]

    ];
    protected $skipValidation     = false;
}