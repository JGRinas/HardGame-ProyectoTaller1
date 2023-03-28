<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table      = 'sales';
    protected $primaryKey = 'id_sale';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user'];

    public function getVentasAll() {
        $db = \Config\Database::connect(); //conecta a la base de datos
        $builder = $db->table('sales'); //tabla venta
        $builder->select('');
        //obtiene la relacion entre  las tablas (trae todos los campos)
        $builder->join('users', 'users.id = sales.id_user');
    
        $query = $builder->get(); //guarda
        return $query->getResultArray(); //retorna un array
    }

    public function getVentasUser($idUser) {
        $db = \Config\Database::connect(); //conecta a la base de datos
        $builder = $db->table('sales'); //tabla venta
        $builder->select('');
        //obtiene la relacion entre  las tablas (trae todos los campos)
        $builder->join('users', 'users.id = sales.id_user');
        $query = $builder->where('id', $idUser);
        $query = $builder->get(); //guarda
        return $query->getResultArray(); //retorna un array
    }

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
      
    ];
    
    protected $validationMessages = [
 
    ];
    protected $skipValidation     = false;
}