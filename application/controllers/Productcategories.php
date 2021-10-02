<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

use chriskacerguis\RestServer\RestController;

class Productcategories extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $noResult = [
            [
                'id' => '',
                'category_name' => ''
            ]
        ];

        $result = $this->product->getProductCategory($id);

        if ($result->num_rows() > 0) {
            $this->response([
                'status' => true,
                'data' => $result->result_array()
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'data' => $noResult
            ], RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = $this->post('data');
        $prodName = $this->post('prodName');

        $result = $this->product->addProductCategories($data, $prodName);

        if ($result > 0) {
            $this->response([
                'status' => true,
            ], RestController::HTTP_CREATED);
        }
    }

    public function index_put()
    {
        $data = $this->put('data');
        $prodId = $this->put('prodId');

        $result = $this->product->updateProductCategories($data, $prodId);

        if ($result > 0) {
            $this->response([
                'status' => true,
            ], RestController::HTTP_CREATED);
        }
    }
}
