<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

    public $table = 'pembelian';
    public $primary = 'kode_beli';
 
    function __construct()
    {
        parent::__construct();
    }

   
    function selectByAll()
    {
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
        $this->db->like('kode_beli', $cari);
    	$this->db->or_like('tanggal_beli', $cari);
    	$this->db->or_like('kode_admin', $cari);
    	$this->db->or_like('total', $cari);
        $this->db->or_like('kode_suplier', $cari);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function jumlahdata_plus($idbarang, $tahun, $bulan){
        return $this->db->query('select avg(pembelian_detail.harga_beli) as harga_beli, substr(pembelian.tanggal_beli,4,2) as bulan , substr(pembelian.tanggal_beli,7,4) as tahun  from pembelian left join pembelian_detail on pembelian.kode_beli=pembelian_detail.kode_beli where pembelian_detail.kode_barang="'.$idbarang.'" AND substr(pembelian.tanggal_beli,7,4)="'.$tahun.'" AND substr(pembelian.tanggal_beli,4,2)>="'.$bulan.'" group by substr(pembelian.tanggal_beli,4,2),substr(pembelian.tanggal_beli,7,4)')->result();
    }

    function jumlahdata_min($idbarang, $tahun, $bulan){
        return $this->db->query('select avg(pembelian_detail.harga_beli) as harga_beli, substr(pembelian.tanggal_beli,4,2) as bulan , substr(pembelian.tanggal_beli,7,4) as tahun  from pembelian left join pembelian_detail on pembelian.kode_beli=pembelian_detail.kode_beli where pembelian_detail.kode_barang="'.$idbarang.'" AND substr(pembelian.tanggal_beli,7,4)="'.$tahun.'" AND substr(pembelian.tanggal_beli,4,2)<"'.$bulan.'" group by substr(pembelian.tanggal_beli,4,2),substr(pembelian.tanggal_beli,7,4)')->result();
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
        $this->db->where($this->primary, $id);
        $this->db->delete('pembelian_detail');
    }
    function laporan($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        return $this->db->query('select pembelian.* from pembelian where  substr(tanggal_beli,4,2)="'.$tgl[1].'" and substr(tanggal_beli,7,4)="'.$tgl[2].'"')->result();

    }
    function beliByTgl($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $data=$this->db->query('select sum(harga_beli*jumlah) as hbeli from pembelian_detail left join pembelian on pembelian_detail.kode_beli=pembelian.kode_beli where  substr(pembelian.tanggal_beli,4,2)="'.$tgl[1].'" and substr(pembelian.tanggal_beli,7,4)="'.$tgl[2].'"')->row();
        return $data->hbeli;
    }

}

/* End of file Pembelian_model.php */
/* Location: ./application/models/Pembelian_model.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */