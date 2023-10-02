<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'stok_produk', 'image'];

    public function insertProduct($data)
    {
        return $this->insert($data);
    }

    public function getData($fetch=null)
    {
        if ($fetch){
            return $this->table('product')->like('nama_produk',$fetch)->orLike('kategori_produk',$fetch);
          }
        $this->table = 'product';
        $builder = $this->db->table('product');
        return $builder->get();
    }

    public function countTotalProducts()
    {
        return $this->countAll();
    }
}
