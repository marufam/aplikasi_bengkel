<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public $table = 'barang';
    public $primary = 'kode_barang';
 
    function __construct()
    {
        parent::__construct();
    }

   
    function selectByAll()
    {   
        $this->db->join('merk', 'barang.kode_merk = merk.kode_merk', 'left');
        return $this->db->get($this->table)->result();
    }

    function selectById($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table)->row();
    }
    
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $cari = NULL) {
        $this->db->like('kode_barang', $cari);
	$this->db->or_like('nama_barang', $cari);
	$this->db->or_like('kode_merk', $cari);
	$this->db->or_like('harga_beli', $cari);
	$this->db->or_like('harga_jual', $cari);
	$this->db->or_like('stok', $cari);
	$this->db->or_like('keterangan', $cari);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->primary, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */