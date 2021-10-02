<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

use chriskacerguis\RestServer\RestController;

class Categories extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }

    public function index_get()
    {
        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name',
            'order' => 'ASC'
        ];

        $result = $this->product->getAll($db['categories']);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result
            ], RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $table = $this->post('table');
        $data = [
            'category_name' => $this->post('category_name')
        ];

        $result = $this->product->addProductOrCategory($data, $table);

        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Kategori ' . $data['category_name'] . ' Berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $deleteType = $this->delete('del-type');

        $cateName = $this->product->deleteCategory($id);
        $this->product->deleteProductCategories($id, $deleteType);

        if ($cateName) {
            $this->response([
                'status' => true,
                'message' => 'Kategori' . $cateName . ' Berhasil dihapus'
            ], RestController::HTTP_OK);
        }
    }

    // IS_UNIQUE
    public function unique_get()
    {
        $str = $this->get('str');

        $this->db->where('category_name', $str);

        $result = $this->db->get('categories');

        if ($result->num_rows() > 0) {
            $this->response([
                'status' => true,
                'message' => 'Nama Kategori yang dimasukan sudah ada'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
            ], RestController::HTTP_OK);
        }
    }
}
