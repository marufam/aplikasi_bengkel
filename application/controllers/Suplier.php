<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Suplier_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        session_start();
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_suplier', 'kode suplier', 'trim|required');
	$this->form_validation->set_rules('nama_suplier', 'nama suplier', 'trim|required');
	$this->form_validation->set_rules('alamat_suplier', 'alamat suplier', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'suplier/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'suplier/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'suplier/index.html';
            $config['first_url'] = base_url() . 'suplier/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Suplier_model->total_rows($cari);
        $suplier = $this->Suplier_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'suplier_data' => $suplier,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('suplier/suplier_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Suplier_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_suplier' => $row->kode_suplier,
		'nama_suplier' => $row->nama_suplier,
		'alamat_suplier' => $row->alamat_suplier,
		'no_telp' => $row->no_telp,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('suplier/suplier_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_suplier' => set_value('kode_suplier',$this->CodeGenerator->buatkode('suplier','kode_suplier',10,'SPL')),
	    'nama_suplier' => set_value('nama_suplier'),
	    'alamat_suplier' => set_value('alamat_suplier'),
	    'no_telp' => set_value('no_telp'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->load->view('suplier/suplier_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_suplier' => $this->input->post('kode_suplier'),
		'nama_suplier' => $this->input->post('nama_suplier'),
		'alamat_suplier' => $this->input->post('alamat_suplier'),
		'no_telp' => $this->input->post('no_telp'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Suplier_model->insert($data);
            redirect(site_url('suplier'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Suplier_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_suplier' => set_value('kode_suplier', $row->kode_suplier),
		'nama_suplier' => set_value('nama_suplier', $row->nama_suplier),
		'alamat_suplier' => set_value('alamat_suplier', $row->alamat_suplier),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->load->view('suplier/suplier_form', $data);
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
		'kode_suplier' => $this->input->post('kode_suplier'),
		'nama_suplier' => $this->input->post('nama_suplier'),
		'alamat_suplier' => $this->input->post('alamat_suplier'),
		'no_telp' => $this->input->post('no_telp'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Suplier_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('suplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Suplier_model->selectById($id);

        if ($row) {
            $this->Suplier_model->delete($id);
            
            redirect(site_url('suplier'));
        }
    }

}

/* End of file Suplier.php */
/* Location: ./application/controllers/Suplier.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */