<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

use chriskacerguis\RestServer\RestController;

class Products extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }

    public function index_get()
    {
        $limit = $this->get('limit');
        $start = $this->get('start');
        $cateId = $this->get('cateId');
        $prodId = $this->get('prodId');

        $db['products'] = [
            'table' => 'products',
            'column' => 'created_at',
            'order' => 'DESC',
            'limit' => $limit,
            'start' => $start
        ];

        if (isset($limit) or isset($start)) {
            $result = $this->product->getAll($db['products']);
        } else if (isset($cateId)) {
            $result = $this->product->getProductByCategory($cateId);
        } else if (isset($prodId)) {
            $result = $this->product->getSingleProduct($prodId);
        }

        if ($result) {
            for ($i = 0; $i < count($result); $i++) {
                $imgTmp = $result[$i]['image'];
                $result[$i]['image'] = base_url('assets/img/' . $imgTmp);
            }
        }

        $this->response([
            'status' => true,
            'data' => $result
        ], RestController::HTTP_OK);
    }

    public function index_post()
    {
        $table = $this->post('table');
        $encode = $this->post('encode');
        $data = [
            'product_name' => $this->post('product_name'),
            'price' =>  $this->post('price')
        ];

        if (isset($encode)) {
            $newFile =  $this->imgDecoding($encode);
            $data['image'] = $newFile;
        }

        $result = $this->product->addProductOrCategory($data, $table);

        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Produk ' . $data['product_name'] . ' Berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $deleteType = $this->delete('del-type');

        $imgName = $this->product->getSingleProduct($id);
        $prodName = $this->product->deleteProduct($id);
        $this->product->deleteProductCategories($id, $deleteType);
        if ($imgName[0]['image'] != 'default.png') {
            unlink(FCPATH . 'assets/img/' . $imgName[0]['image']);
        }

        if ($prodName) {
            $this->response([
                'status' => true,
                'message' => 'Produk' . $prodName . ' Berhasil dihapus'
            ], RestController::HTTP_OK);
        }
    }

    public function index_put()
    {
        $data = [
            'id' => $this->put('id'),
            'product_name' => $this->put('product_name'),
            'price' =>  $this->put('price'),
        ];
        $encode = $this->put('encode');
        $image = explode('/', $this->put('old_image'));
        $old_image = $image[6];

        if (isset($encode) and isset($old_image)) {
            if ($old_image != 'default.png') {
                unlink(FCPATH . 'assets/img/' . $old_image);
            }
            $newFile =  $this->imgDecoding($encode);
            $data['image'] = $newFile;
        } else {
            $image = explode('/', $this->put('image'));
            $data['image'] = $image[6];
        }

        $result = $this->product->updateProduct($data);

        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Produk ' . $data['product_name'] . ' Berhasil diubah'
            ], RestController::HTTP_CREATED);
        }
    }

    public function countProduct_get()
    {
        $result = $this->product->countAllProducts();

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function countProductByCategory_get()
    {
        $cateId = $this->get('cateId');

        $result = $this->product->countProductsByCategory($cateId);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'data' => 0
            ], RestController::HTTP_OK);
        }
    }

    // SEARCH
    public function searchProduct_get()
    {
        $keyword = '';
        $output = '';

        if ($this->get('cari-barang')) {
            $keyword = $this->input->get('cari-barang');
        }

        $products = $this->product->liveSearch($keyword);

        $output = $this->searchOutput($products);

        echo $output;
    }

    public function searchProductByCategory_get()
    {
        $keyword = '';
        $idCategory = $this->get('id-category');
        $output = '';

        if ($this->get('cari-barang')) {
            $keyword = $this->get('cari-barang');
        }

        $products = $this->product->liveSearchByCategory($keyword, $idCategory);

        $output = $this->searchOutput($products);

        echo $output;
    }

    private function searchOutput($products)
    {
        $output = '';

        $output .= '
        <table class="table table-striped table-sm">
        <thead>
            <tr class="d-flex">
                <th scope="col">#</th>
                <th scope="col" class="col-4">Nama Barang</th>
                <th scope="col" class="col-3">Harga</th>
                <th scope="col" class="col-3">Kategori</th>
                <th scope="col" class="col-2">Gambar</th>
            </tr>
        </thead>
    ';
        if ($products->num_rows() > 0) {
            $i = 1;
            foreach ($products->result_array() as $product) {

                $productCategories = $this->product->getProductCategory($product['id'])->result_array();

                $output .= '
                <tr class="d-flex">
                    <th scope="row">' . $i++ . '</th>
                    <td class="col-4">
                        <span>' . $product['product_name'] . '</span>
                        <div class="product-action">
                        <a href="' . base_url('products/updateproduct/' . $product['id']) . '" class="badge bg-primary text-decoration-none">Ubah</a>
                            <a onclick="return confirm()" href="' . base_url('products/deleteproduct/' . $product['id']) . '" class="badge bg-danger text-decoration-none">Hapus</a>
                        </div>
                    </td>
                <td class="col-3">Rp ' . $product['price'] . '</td>
                <td class="col-3">
            ';

                foreach ($productCategories as $productCategory) {
                    $output .= '<a href="" class="badge bg-success text-decoration-none mx-2">' . $productCategory['category_name'] . '</a>';
                }

                $output .= '
                        </td>
                        <td class="col-2">
                            <a href="#" class="text-decoration-none show-image" data-bs-toggle="modal" data-bs-target="#exampleModal" data-prod-name="' . $product['product_name'] . '" data-img="' . $product['image'] . '">
                                <img src="' . base_url('assets/img/' . $product['image']) . '" class="img-fluid">
                            </a>
                        </td>
                    </tr>
                </tbody>
            ';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="5">Produk Tidak Ditemukan</td>
                </tr>
            </tbody>
        ';
        }
        $output .= '</table>';

        return $output;
    }

    // IS_UNIQUE
    public function unique_get()
    {
        $str = $this->get('str');

        $this->db->where('product_name', $str);

        $result = $this->db->get('products');

        if ($result->num_rows() > 0) {
            $this->response([
                'status' => true,
                'message' => 'Nama Produk yang dimasukan sudah ada'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
            ], RestController::HTTP_OK);
        }
    }

    private function imgDecoding($encod)
    {
        list($type) = explode(';', $encod);
        $type = substr($type, 11);
        $randomStr = mt_rand();
        $newFile = $randomStr . '.' . $type;
        $newPath = FCPATH . 'assets/img/' . $newFile;
        $source  = fopen($encod, 'r');
        $destination =  fopen($newPath, 'w');

        stream_copy_to_stream($source, $destination);

        fclose($source);
        fclose($destination);

        return $newFile;
    }

    private function convertImgtoUrl($result)
    {
        for ($i = 0; $i < count($result); $i++) {
            $imgTmp = $result[$i]['image'];
            $result[$i]['image'] = base_url('assets/img/' . $imgTmp);
        }

        return $result;
    }
}
