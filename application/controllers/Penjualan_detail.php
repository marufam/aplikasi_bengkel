<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penjualan_detail_model');
        $this->load->library('form_validation');
        session_start();
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_jual', 'kode jual', 'trim|required');
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');
	$this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('subtotal', 'subtotal', 'trim|required|numeric');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'penjualan_detail/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'penjualan_detail/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'penjualan_detail/index.html';
            $config['first_url'] = base_url() . 'penjualan_detail/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penjualan_detail_model->total_rows($cari);
        $penjualan_detail = $this->Penjualan_detail_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'penjualan_detail_data' => $penjualan_detail,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('penjualan_detail/penjualan_detail_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Penjualan_detail_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_jual' => $row->kode_jual,
		'kode_barang' => $row->kode_barang,
		'harga_jual' => $row->harga_jual,
		'harga_beli' => $row->harga_beli,
		'jumlah' => $row->jumlah,
		'subtotal' => $row->subtotal,
	    );
            $this->load->view('penjualan_detail/penjualan_detail_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        $data = array(
           
	    'kode_jual' => set_value('kode_jual'),
	    'kode_barang' => set_value('kode_barang'),
	    'harga_jual' => set_value('harga_jual'),
	    'harga_beli' => set_value('harga_beli'),
	    'jumlah' => set_value('jumlah'),
	    'subtotal' => set_value('subtotal'),
	);
        $this->load->view('penjualan_detail/penjualan_detail_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->datainsert();
        } else {
            $data = array(
		'kode_jual' => $this->input->post('kode_jual'),
		'kode_barang' => $this->input->post('kode_barang'),
		'harga jual' => $this->input->post('harga_jual'),
		'harga_beli' => $this->input->post('harga_beli'),
		'jumlah' => $this->input->post('jumlah'),
		'subtotal' => $this->input->post('subtotal'),
	    );

            $this->Penjualan_detail_model->insert($data);
            redirect(site_url('penjualan_detail'));
        }
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Penjualan_detail_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_jual' => set_value('kode_jual', $row->kode_jual),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'harga_jual' => set_value('harga_jual', $row->harga_jual),
		'harga_beli' => set_value('harga_beli', $row->harga_beli),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'subtotal' => set_value('subtotal', $row->subtotal),
	    );
            $this->load->view('penjualan_detail/penjualan_detail_form', $data);
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
		'kode_jual' => $this->input->post('kode_jual'),
		'kode_barang' => $this->input->post('kode_barang'),
		'harga_jual' => $this->input->post('harga_jual'),
		'harga_beli' => $this->input->post('harga_beli'),
		'jumlah' => $this->input->post('jumlah'),
		'subtotal' => $this->input->post('subtotal'),
	    );

            $this->Penjualan_detail_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('penjualan_detail'));
        }
    }
    
    public function delete($id,$barang) 
    {
        $row = $this->Penjualan_detail_model->selectById($id);

        if ($row) {
            $this->Penjualan_detail_model->delete($id,$barang);
            if($this->uri->segment(5)<>"" and $this->uri->segment(5)==1){
                redirect(site_url('home'));    
            }else{
                redirect(site_url('penjualan/insert'));
            }
        }
    }

}

/* End of file Penjualan_detail.php */
/* Location: ./application/controllers/Penjualan_detail.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */