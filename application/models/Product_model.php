<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Product_model extends CI_Model
{
    public function getAll($db)
    {
        $this->db->from($db['table']);
        if (isset($db['limit'])) {
            $this->db->limit($db['limit'], $db['start']);
        }
        $this->db->order_by($db['column'], $db['order']);
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function countAllProducts()
    {
        return $this->db->get('products')->num_rows();
    }

    public function getSingleProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->result_array();
    }

    public function getProductByCategory($id)
    {
        $query = "SELECT `products`.* 
                    FROM `products` JOIN `product_categories`
                    ON `products`.`id` = `product_categories`.`product_id`
                    WHERE `product_categories`.`category_id` = $id
                    ORDER BY `products`.`created_at`";

        return $this->db->query($query)->result_array();
    }

    public function countProductsByCategory($cateId)
    {
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->join('product_categories', 'products.id = product_categories.product_id');
        $this->db->where('product_categories.category_id', $cateId);

        return $this->db->get()->num_rows();
    }

    public function getProductCategory($id)
    {
        // Gunakan BackTick ``
        $query = "SELECT `categories`.`id`, `category_name`
                                FROM `categories` JOIN `product_categories`
                                ON `categories`.`id` = `product_categories`.`category_id`
                                WHERE `product_categories`.`product_id` = $id";

        return $this->db->query($query);
    }

    // INSERT, DELETE, UPDATE
    public function addProductOrCategory($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function addProductCategories($data, $prodName)
    {
        $getProdId = $this->db->get_where('products', ['product_name' => $prodName])->row_array();

        $return = [];
        foreach ($data as $value) {
            $return[] = ['product_id' => $getProdId['id'], 'category_id' => $value];
        }

        $this->db->insert_batch('product_categories', $return);
        return $this->db->affected_rows();
    }

    public function updateProduct($data)
    {
        $this->db->replace('products', $data);
        return $this->db->affected_rows();
    }

    public function updateProductCategories($data, $prodId)
    {
        $this->db->where('product_id', $prodId);
        $this->db->delete('product_categories');

        $return = [];
        foreach ($data as $value) {
            $return[] = ['product_id' => $prodId, 'category_id' => $value];
        }

        $this->db->insert_batch('product_categories', $return);
        return $this->db->affected_rows();
    }

    public function deleteProduct($id)
    {
        $prodName = $this->getSingleProduct($id);

        $this->db->where('id', $id);
        $this->db->delete('products');

        return $prodName[0]['product_name'];
    }

    public function deleteCategory($id)
    {
        $prodName = $this->db->get_where('categories', ['id' => $id])->row_array();

        $this->db->where('id', $id);
        $this->db->delete('categories');

        return $prodName['category_name'];
    }

    public function deleteProductCategories($id, $status)
    {
        if ($status == 'prodDelete') {
            $this->db->where('product_id', $id);
        } else {
            $this->db->where('category_id', $id);
        }

        $this->db->delete('product_categories');
    }

    // SEARCHING
    public function liveSearch($data)
    {
        $this->db->select("*");
        $this->db->from("products");
        if ($data != '') {
            $this->db->like('product_name', $data);
        } else {
            $this->db->limit(5, 0);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get();
    }

    public function liveSearchByCategory($data, $id)
    {
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->join('product_categories', 'products.id = product_categories.product_id');
        $this->db->where('product_categories.category_id', $id);
        if ($data != '') {
            $this->db->like('products.product_name', $data, 'both');
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get();
    }
}
