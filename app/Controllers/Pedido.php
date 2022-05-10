<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Pedido extends BaseController
{
    /**
     * Get all Pedidos
     * @return Response
     */
    public function index()
    {
        $model = new PedidoModel();
        return $this->getResponse(
            $model->findAll()
        );
        /* $model = new PedidoModel();
        return $this->getResponse(
            [
                'message' => 'Pedidos retrieved successfully',
                'pedidos' => $model->findAll()
            ]
        ); */
    }

    /**
     * Create a new Pedido
     */
    public function store()
    {
        $rules = [
            'descripcion' => 'required|min_length[5]|max_length[50]',
            'npedimento' => 'required|min_length[1]|max_length[10]',
            'psalida' => 'required|min_length[5]|max_length[100]',
            'pdestino' => 'required|min_length[5]|max_length[100]',
            'estatus' => 'required|min_length[5]|max_length[100]',
            'image_url' => 'max_length[200]'
        ];

 $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $PedidoInsert    = $input['npedimento'];

        $model = new PedidoModel();
        $model->save($input);
        

        $pedido = $model->where('npedimento', $PedidoInsert)->first();

        return $this->getResponse(
            [
                'message' => 'Pedido added successfully',
                'pedido' => $pedido
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($id)
    {
        try {

            $model = new PedidoModel();
            $pedido = $model->findClientById($id);

            return $this->getResponse(
                [
                    'message' => 'Pedido retrieved successfully',
                    'pedido' => $pedido
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find pedido for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id)
    {
        try {

            $model = new PedidoModel();
            $model->findClientById($id);

          $input = $this->getRequestInput($this->request);

          

            $model->update($id, $input);
            $pedido = $model->findClientById($id);

            return $this->getResponse(
                [
                    'message' => 'Pedido updated successfully',
                    'pedido' => $pedido
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

            $model = new PedidoModel();
            $pedido = $model->findClientById($id);
            $model->delete($pedido);

            return $this
                ->getResponse(
                    [
                        'message' => 'Pedido deleted successfully',
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

}
