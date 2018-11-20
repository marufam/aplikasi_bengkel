<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_admin', 'kode admin', 'trim|required');
	$this->form_validation->set_rules('nama_admin', 'nama admin', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('psswd', 'psswd', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'admin/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'admin/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'admin/index.html';
            $config['first_url'] = base_url() . 'admin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_model->total_rows($cari);
        $admin = $this->Admin_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'admin_data' => $admin,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin/admin_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Admin_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_admin' => $row->kode_admin,
		'nama_admin' => $row->nama_admin,
		'username' => $row->username,
		'psswd' => $row->psswd,
	    );
            $this->load->view('admin/admin_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_admin' => set_value('kode_admin', $this->CodeGenerator->buatkode('admin','kode_admin',10,'ADM')),
	    'nama_admin' => set_value('nama_admin'),
	    'username' => set_value('username'),
	    'psswd' => set_value('psswd'),
	);
        $this->load->view('admin/admin_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_admin' => $this->input->post('kode_admin'),
		'nama_admin' => $this->input->post('nama_admin'),
		'username' => $this->input->post('username'),
		'psswd' => $this->input->post('psswd'),
	    );

            $this->Admin_model->insert($data);
            redirect(site_url('admin'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Admin_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_admin' => set_value('kode_admin', $row->kode_admin),
		'nama_admin' => set_value('nama_admin', $row->nama_admin),
		'username' => set_value('username', $row->username),
		'psswd' => set_value('psswd', $row->psswd),
	    );
            $this->load->view('admin/admin_form', $data);
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
		'kode_admin' => $this->input->post('kode_admin'),
		'nama_admin' => $this->input->post('nama_admin'),
		'username' => $this->input->post('username'),
		'psswd' => $this->input->post('psswd'),
	    );

            $this->Admin_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('admin'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Admin_model->selectById($id);

        if ($row) {
            $this->Admin_model->delete($id);
            
            redirect(site_url('admin'));
        }
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */