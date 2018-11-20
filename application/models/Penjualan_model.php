<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public $table = 'penjualan';
    public $primary = 'kode_jual';
 
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
        $this->db->like('kode_jual', $cari);
    	$this->db->or_like('tanggal_jual', $cari);
    	$this->db->or_like('kode_admin', $cari);
    	$this->db->or_like('kode_karyawan', $cari);
    	$this->db->or_like('keterangan', $cari);
    	$this->db->or_like('ongkos_karyawan', $cari);
    	$this->db->or_like('total', $cari);
    	$this->db->or_like('bayar', $cari);
        $this->db->or_like('pelanggan', $cari);
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

    function jumlahdata_plus($idbarang, $tahun, $bulan){
        return $this->db->query('select sum(penjualan_detail.jumlah) as jumlah, substr(penjualan.tanggal_jual,4,2) as bulan , substr(penjualan.tanggal_jual,7,4) as tahun  from penjualan left join penjualan_detail on penjualan.kode_jual=penjualan_detail.kode_jual where penjualan_detail.kode_barang="'.$idbarang.'" AND substr(penjualan.tanggal_jual,7,4)="'.$tahun.'" AND substr(penjualan.tanggal_jual,4,2)>="'.$bulan.'" group by substr(penjualan.tanggal_jual,4,2),substr(penjualan.tanggal_jual,7,4)')->result();
    }

    function jumlahdata_min($idbarang, $tahun, $bulan){
        return $this->db->query('select sum(penjualan_detail.jumlah) as jumlah, substr(penjualan.tanggal_jual,4,2) as bulan , substr(penjualan.tanggal_jual,7,4) as tahun  from penjualan left join penjualan_detail on penjualan.kode_jual=penjualan_detail.kode_jual where penjualan_detail.kode_barang="'.$idbarang.'" AND substr(penjualan.tanggal_jual,7,4)="'.$tahun.'" AND substr(penjualan.tanggal_jual,4,2)<"'.$bulan.'" group by substr(penjualan.tanggal_jual,4,2),substr(penjualan.tanggal_jual,7,4)')->result();
    }

    function gajiAll($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        return $this->db->query('select  SUM(ongkos_karyawan) as gaji, karyawan.*, penjualan.* from penjualan left join karyawan on penjualan.kode_karyawan=karyawan.kode_karyawan where  substr(tanggal_jual,4,2)="'.$tgl[1].'" and substr(tanggal_jual,7,4)="'.$tgl[2].'" GROUP BY penjualan.kode_karyawan')->result();

    }
    function gajiAllby($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $sql=$this->db->query('select  SUM(ongkos_karyawan) as gaji from penjualan where  substr(tanggal_jual,4,2)="'.$tgl[1].'" and substr(tanggal_jual,7,4)="'.$tgl[2].'"')->row();
        return $sql->gaji;

    }
    function laporan($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        
        $tgl=explode('-', $tanggal);
       
        return $this->db->query('select penjualan.*, substr(tanggal_jual,4,2),substr(tanggal_jual,7,4) from penjualan where  substr(tanggal_jual,4,2)="'.$tgl[1].'" and substr(tanggal_jual,7,4)="'.$tgl[2].'"')->result();

    }
    function omsetAll(){
        $data=$this->db->query('select (sum(harga_jual*jumlah)-sum(harga_beli*jumlah)) as omset from penjualan_detail')->row();
        return $data->omset;
    }
    function omsetByTgl($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $data=$this->db->query('select (sum(harga_jual*jumlah)-sum(harga_beli*jumlah)) as omset from penjualan_detail left join penjualan on penjualan_detail.kode_jual=penjualan.kode_jual where  substr(penjualan.tanggal_jual,4,2)="'.$tgl[1].'" and substr(penjualan.tanggal_jual,7,4)="'.$tgl[2].'"')->row();
        return $data->omset;
    }

    function beliByTgl($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $data=$this->db->query('select sum(harga_beli*jumlah) as hbeli from penjualan_detail left join penjualan on penjualan_detail.kode_jual=penjualan.kode_jual where  substr(penjualan.tanggal_jual,4,2)="'.$tgl[1].'" and substr(penjualan.tanggal_jual,7,4)="'.$tgl[2].'"')->row();
        return $data->hbeli;
    }
     function jualByTgl($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $data=$this->db->query('select sum(harga_jual*jumlah) as hjual from penjualan_detail left join penjualan on penjualan_detail.kode_jual=penjualan.kode_jual where  substr(penjualan.tanggal_jual,4,2)="'.$tgl[1].'" and substr(penjualan.tanggal_jual,7,4)="'.$tgl[2].'"')->row();
        return $data->hjual;
    }
    function totalByTgl($tanggal){
        $tanggal=date('d-m-Y',strtotime($tanggal));
        $tgl=explode('-', $tanggal);
        $data=$this->db->query('select sum(total) as total from penjualan where  substr(penjualan.tanggal_jual,4,2)="'.$tgl[1].'" and substr(penjualan.tanggal_jual,7,4)="'.$tgl[2].'"')->row();
        return $data->total;
    }

}

/* End of file Penjualan_model.php */
/* Location: ./application/models/Penjualan_model.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */