<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Merk_model extends CI_Model
{

    public $table = 'merk';
    public $primary = 'kode_merk';
 
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
        $this->db->like('kode_merk', $cari);
	$this->db->or_like('merk', $cari);
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

/* End of file Merk_model.php */
/* Location: ./application/models/Merk_model.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */