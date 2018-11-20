<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        $this->load->model('Merk_model');
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('kode_merk', 'kode merk', 'trim|required');
	$this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'barang/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($cari);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('barang/barang_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Barang_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'kode_merk' => $row->kode_merk,
		'harga_beli' => $row->harga_beli,
		'harga_jual' => $row->harga_jual,
		'stok' => $row->stok,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('barang/barang_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_barang' => set_value('kode_barang',$this->CodeGenerator->buatkode('barang','kode_barang',10,'BRG')),
	    'nama_barang' => set_value('nama_barang'),
	    'kode_merk' => set_value('kode_merk'),
	    'harga_beli' => set_value('harga_beli'),
	    'harga_jual' => set_value('harga_jual'),
	    'stok' => set_value('stok'),
	    'keterangan' => set_value('keterangan'),
	);
        $data['listmerk']=$this->Merk_model->selectByAll();
        $this->load->view('barang/barang_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang'),
		'nama_barang' => $this->input->post('nama_barang'),
		'kode_merk' => $this->input->post('kode_merk'),
		'harga_beli' => $this->input->post('harga_beli'),
		'harga_jual' => $this->input->post('harga_jual'),
		'stok' => $this->input->post('stok'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Barang_model->insert($data);
            redirect(site_url('barang'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Barang_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'kode_merk' => set_value('kode_merk', $row->kode_merk),
		'harga_beli' => set_value('harga_beli', $row->harga_beli),
		'harga_jual' => set_value('harga_jual', $row->harga_jual),
		'stok' => set_value('stok', $row->stok),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $data['listmerk']=$this->Merk_model->selectByAll();
            $this->load->view('barang/barang_form', $data);
        }
        $this->load->view('foot');
    }
    
    public function update() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->dataupdate($this->uri->segment(3));
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang'),
		'nama_barang' => $this->input->post('nama_barang'),
		'kode_merk' => $this->input->post('kode_merk'),
		'harga_beli' => $this->input->post('harga_beli'),
		'harga_jual' => $this->input->post('harga_jual'),
		'stok' => $this->input->post('stok'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Barang_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->selectById($id);

        if ($row) {
            $this->Barang_model->delete($id);
            
            redirect(site_url('barang'));
        }
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */