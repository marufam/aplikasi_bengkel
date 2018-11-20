<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Merk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Merk_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        session_start();
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_merk', 'kode merk', 'trim|required');
	$this->form_validation->set_rules('merk', 'merk', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'merk/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'merk/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'merk/index.html';
            $config['first_url'] = base_url() . 'merk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Merk_model->total_rows($cari);
        $merk = $this->Merk_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'merk_data' => $merk,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('merk/merk_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Merk_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_merk' => $row->kode_merk,
		'merk' => $row->merk,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('merk/merk_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_merk' => set_value('kode_merk',$this->CodeGenerator->buatkode('merk','kode_merk',10,'MRK')),
	    'merk' => set_value('merk'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->load->view('merk/merk_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_merk' => $this->input->post('kode_merk'),
		'merk' => $this->input->post('merk'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Merk_model->insert($data);
            redirect(site_url('merk'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Merk_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_merk' => set_value('kode_merk', $row->kode_merk),
		'merk' => set_value('merk', $row->merk),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->load->view('merk/merk_form', $data);
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
		'kode_merk' => $this->input->post('kode_merk'),
		'merk' => $this->input->post('merk'),
		'keterangan' => $this->input->post('keterangan'),
	    );

            $this->Merk_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('merk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Merk_model->selectById($id);

        if ($row) {
            $this->Merk_model->delete($id);
            
            redirect(site_url('merk'));
        }
    }

}

/* End of file Merk.php */
/* Location: ./application/controllers/Merk.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */