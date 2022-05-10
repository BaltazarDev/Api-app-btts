<?php

namespace App\Controllers;

use App\Models\ArancelesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Aranceles extends BaseController
{
    /**
     * Get all Aranceles
     * @return Response
     */
    public function index()
    {
        $model = new ArancelesModel();
        return $this->getResponse(
            $model->findAll()
            /* [
                'message' => 'Aranceles retrieved successfully',
                'aranceles' => $model->findAll()
            ] */
        );
    }

    /**
     * Create a new Arancel
     */
    public function store()
    {
        $rules = [
            'fraccionarancelaria' => 'min_length[1]|max_length[10]',
            'descripcion' => 'min_length[3]|max_length[100]',
            'fechainicio' => 'min_length[10]|max_length[15]',
            'fechafin' => 'max_length[15]',
            'umt' => 'max_length[5]',
            'imp' => 'max_length[5]',
            'exp' => 'max_length[5]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $fracc = $input['fraccionarancelaria'];

        $model = new ArancelesModel();
        $model->save($input);
        

        $arancel = $model->where('fraccionarancelaria', $fracc)->first();

        return $this->getResponse(
            [
                'message' => 'Arancel añadido correctamente',
                'arancel' => $arancel
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($id)
    {
        try {

            $model = new ArancelesModel();
            $arancel = $model->findArancelById($id);
            return $this->getResponse([$arancel]);
            /* return $this->getResponse(
                [
                    'message' => 'Aranceles encontrados',
                    'arancel' => $arancel
                ]
            ); */

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'No se pudo encontrar el Arancel con el ID especificado'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id)
    {
        try {

            $model = new ArancelesModel();
            $model->findArancelById($id);

          $input = $this->getRequestInput($this->request);

          

            $model->update($id, $input);
            $arancel = $model->findArancelById($id);

            return $this->getResponse(
                [
                    'message' => 'Arancel actualizado',
                    'arancel' => $arancel
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function destroy($id)
    {
        try {

            $model = new ArancelesModel();
            $arancel = $model->findArancelById($id);
            $model->delete($arancel);

            return $this
                ->getResponse(
                    [
                        'message' => 'Arancel eliminado',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function buscar($descripcion)
    {
        $model = new ArancelesModel();
        $builder = $model->table('arancel');
        $builder->select('fraccionarancelaria, descripcion');
        $builder->where('descripcion !=', $descripcion);
        $query = $builder->get();
    }

}
