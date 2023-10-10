<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'stok_produk', 'image'];

    public function getData($fetch = null)
    {
        $builder = $this->db->table('product');
        if ($fetch) {
            $fetch = strtolower($fetch);
            return $this->table('product')->like('LOWER(nama_produk)', $fetch, 'both')->orLike('LOWER(kategori_produk)', $fetch, 'both');
        }
        return $builder->get();
    }

    public function countTotalProducts($fetch = null)
    {
        $builder = $this->db->table('product');
        if ($fetch) {
            $fetch = strtolower($fetch);
            return $this->table('product')->like('LOWER(nama_produk)', $fetch, 'both')->orLike('LOWER(kategori_produk)', $fetch, 'both')->countAllResults();
        }
        return $builder->countAllResults();
    }
}