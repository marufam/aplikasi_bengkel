<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian_detail_model extends CI_Model
{

    public $table = 'pembelian_detail';
    public $primary = 'kode_beli';
 
    function __construct()
    {
        parent::__construct();
    }

   
    function selectByAll()
    {
        $this->db->join('barang', 'barang.kode_barang = pembelian_detail.kode_barang', 'left');
        return $this->db->get($this->table)->result();
    }

    function selectById($id)
    {
        $this->db->join('barang', 'barang.kode_barang = pembelian_detail.kode_barang', 'left');
        $this->db->where($this->primary, $id);
        return $this->db->get($this->table)->result();

    }
    function jumlahbyid($id,$barang){
        $this->db->where($this->primary, $id);
        $this->db->where('kode_barang', $barang);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function totalall($id){
        $jumlah=$this->db->query("select sum(subtotal) as total from pembelian_detail where kode_beli='$id'")->row();
        return $jumlah->total;
    }
    
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $cari = NULL) {
        $this->db->like('', $cari);
	$this->db->or_like('kode_beli', $cari);
	$this->db->or_like('kode_barang', $cari);
	$this->db->or_like('harga_beli', $cari);
	$this->db->or_like('jumlah', $cari);
	$this->db->or_like('subtotal', $cari);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id,$barang, $data)
    {
        $this->db->where($this->primary, $id);
        $this->db->where('kode_barang', $barang);
        $this->db->update($this->table, $data);
    }

    function delete($id,$barang)
    {
        $this->db->where($this->primary, $id);
        $this->db->where('kode_barang', $barang);
        $this->db->delete($this->table);
    }
    function deletebykey($id)
    {
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
    }
    function updatestok($id)
    {
        $this->db->where($this->primary, $id);
        $data=$this->db->get('pembelian_detail')->result();
        foreach ($data as $row) {
            $this->db->where('kode_barang', $row->kode_barang);
            $this->db->query("update barang set stok=stok+".$row->jumlah." where kode_barang='$row->kode_barang' ");
        }
    }

}

/* End of file Pembelian_detail_model.php */
/* Location: ./application/models/Pembelian_detail_model.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */