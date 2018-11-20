<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Karyawan_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
    }
     public function _rule() 
    {
        $this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
        $this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
        $this->form_validation->set_rules('alamat_karyawan', 'alamat karyawan', 'trim|required');
        $this->form_validation->set_rules('telp_karyawan', 'telp karyawan', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'karyawan/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'karyawan/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'karyawan/index.html';
            $config['first_url'] = base_url() . 'karyawan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Karyawan_model->total_rows($cari);
        $karyawan = $this->Karyawan_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'karyawan_data' => $karyawan,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('karyawan/karyawan_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Karyawan_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_karyawan' => $row->kode_karyawan,
		'nama_karyawan' => $row->nama_karyawan,
		'alamat_karyawan' => $row->alamat_karyawan,
        'telp_karyawan' => $row->telp_karyawan,
        'username' => $row->username,
		'password' => $row->password,
	    );
            $this->load->view('karyawan/karyawan_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_karyawan' => set_value('kode_karyawan',$this->CodeGenerator->buatkode('karyawan','kode_karyawan',10,'KRY')),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'alamat_karyawan' => set_value('alamat_karyawan'),
        'telp_karyawan' => set_value('telp_karyawan'),
        'username' => set_value('username'),
	    'password' => set_value('password'),
	);
        $this->load->view('karyawan/karyawan_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan'),
		'nama_karyawan' => $this->input->post('nama_karyawan'),
		'alamat_karyawan' => $this->input->post('alamat_karyawan'),
        'telp_karyawan' => $this->input->post('telp_karyawan'),
        'username' => $this->input->post('username'),
		'password' => $this->input->post('password'),
	    );

            $this->Karyawan_model->insert($data);
            redirect(site_url('karyawan'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Karyawan_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'alamat_karyawan' => set_value('alamat_karyawan', $row->alamat_karyawan),
        'telp_karyawan' => set_value('telp_karyawan', $row->telp_karyawan),
        'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
	    );
            $this->load->view('karyawan/karyawan_form', $data);
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
		'kode_karyawan' => $this->input->post('kode_karyawan'),
		'nama_karyawan' => $this->input->post('nama_karyawan'),
		'alamat_karyawan' => $this->input->post('alamat_karyawan'),
        'telp_karyawan' => $this->input->post('telp_karyawan'),
        'username' => $this->input->post('username'),
		'password' => $this->input->post('password'),
	    );

            $this->Karyawan_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('karyawan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Karyawan_model->selectById($id);

        if ($row) {
            $this->Karyawan_model->delete($id);
            
            redirect(site_url('karyawan'));
        }
    }

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */