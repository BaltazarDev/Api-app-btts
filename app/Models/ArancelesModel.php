<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ArancelesModel extends Model
{
    protected $table = 'arancel';
    protected $allowedFields = [
        'fraccionarancelaria',
        'descripcion',
        'fechainicio',
        'fechafin',
        'umt',
        'imp',
        'exp'
    ];
    protected $updatedField = 'updated_at';

    public function findArancelById($id)
    {
        $arancel = $this
            ->asArray()
            ->where(['descripcion' => $id])
            ->first();

        if (!$arancel) throw new Exception('Could not find aranceles for specified ID');

        return $arancel;
    }

}
