<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PedidoModel extends Model
{
    protected $table = 'pedido';
    protected $allowedFields = [
        'descripcion',
        'npedimento',
        'psalida',
        'pdestino',
        'estatus',
        'image_url'
    ];
    protected $updatedField = 'updated_at';

    public function findPedidoById($id)
    {
        $pedido = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$pedido) throw new Exception('Could not find pedido for specified ID');

        return $pedido;
    }
}
