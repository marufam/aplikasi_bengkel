<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembelian_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        $this->load->model('Barang_model');
        $this->load->model('Pembelian_detail_model');
        $this->load->model('Suplier_model');
        session_start();
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_beli', 'kode beli', 'trim|required');
	$this->form_validation->set_rules('tanggal_beli', 'tanggal beli', 'trim|required');
	$this->form_validation->set_rules('kode_admin', 'kode admin', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
    $this->form_validation->set_rules('kode_suplier', 'total', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'pembelian/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'pembelian/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'pembelian/index.html';
            $config['first_url'] = base_url() . 'pembelian/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembelian_model->total_rows($cari);
        $pembelian = $this->Pembelian_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'pembelian_data' => $pembelian,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pembelian/pembelian_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Pembelian_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_beli' => $row->kode_beli,
		'tanggal_beli' => $row->tanggal_beli,
		'kode_suplier' => $row->kode_suplier,
        'kode_admin' => $row->kode_admin,
		'total' => $row->total,
	    );
             $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Pembelian_detail_model->selectById($data['kode_beli']);
            $this->load->view('pembelian/pembelian_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');

        $data = array(
           
	    'kode_beli' => set_value('kode_beli',$this->CodeGenerator->buatkode('pembelian','kode_beli',10,'TRB')),
	    'tanggal_beli' => set_value('tanggal_beli', date('d-m-Y')),
	    'kode_admin' => set_value('kode_admin', $_SESSION['kode']),
	    'total' => set_value('total',$this->Pembelian_detail_model->totalall($this->input->post('kode_beli'))),
        'kode_suplier' => set_value('kode_suplier'),
	);
        $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Pembelian_detail_model->selectById($data['kode_beli']);
        $data['listsuplier']=$this->Suplier_model->selectByAll();
        $this->load->view('pembelian/pembelian_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        
        $total=0;
        
        if($this->input->post('submitlist')<>""){
            if($this->input->post('jumlah')<>""){
                $cek=$this->Pembelian_detail_model->jumlahbyid($this->input->post('kode_beli'), $this->input->post('kode_barang'));
                var_dump($cek);
                if($cek==0){
                    $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                    $data=array(
                        'kode_beli' => $this->input->post('kode_beli'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_beli*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Pembelian_detail_model->insert($data);   
                    redirect(site_url('pembelian/insert'),'refresh');
                }else{
                     $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                    $data=array(
                        'kode_beli' => $this->input->post('kode_beli'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_beli*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Pembelian_detail_model->update($data['kode_beli'],$data['kode_barang'],$data);   
                    redirect(site_url('pembelian/insert'),'refresh');
                }
            }
        }else{
            $this->_rule();
            if ($this->form_validation->run() == FALSE and $this->input->post('total')==null) {
                $this->datainsert();
            } else {
               
                $data = array(
            'kode_beli' => $this->input->post('kode_beli'),
            'tanggal_beli' => $this->input->post('tanggal_beli'),
            'kode_admin' => $this->input->post('kode_admin'),
            'total' => $this->Pembelian_detail_model->totalall($this->input->post('kode_beli')),
            'kode_suplier' => $this->input->post('kode_suplier'),
            );
                $this->Pembelian_detail_model->updatestok($this->input->post('kode_beli'));
                $this->Pembelian_model->insert($data);
                redirect(site_url('pembelian'));
            
            }
        }

       $this->load->view('foot');
    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Pembelian_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_beli' => set_value('kode_beli', $row->kode_beli),
		'tanggal_beli' => set_value('tanggal_beli', $row->tanggal_beli),
		'kode_admin' => set_value('kode_admin', $row->kode_admin),
		'total' => set_value('total', $this->Pembelian_detail_model->totalall($this->uri->segment(3))),
        'kode_suplier' => set_value('kode_suplier', $row->kode_suplier),
	    );
             $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Pembelian_detail_model->selectById($data['kode_beli']);
            $this->load->view('pembelian/pembelian_form', $data);
        }
        $this->load->view('foot');
    }
    
    public function update() 
    {
        
        
        if($this->input->post('submitlist')<>""){
            if($this->input->post('jumlah')<>""){
                $cek=$this->Pembelian_detail_model->jumlahbyid($this->input->post('kode_beli'), $this->input->post('kode_barang'));
                var_dump($cek);
                if($cek==0){
                    $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                    $data=array(
                        'kode_beli' => $this->input->post('kode_beli'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_beli*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Pembelian_detail_model->insert($data);   
                    redirect(site_url('pembelian/update/'.$this->uri->segment(3)),'refresh');
                }else{
                     $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                    $data=array(
                        'kode_beli' => $this->input->post('kode_beli'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_beli*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Pembelian_detail_model->update($data['kode_beli'],$data['kode_barang'],$data);   
                    redirect(site_url('pembelian/update/'.$this->uri->segment(3)),'refresh');
                }
            }
        }else{
        
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->dataupdate($this->uri->segment(3));
        } else {
            $data = array(
		'kode_beli' => $this->input->post('kode_beli'),
		'tanggal_beli' => $this->input->post('tanggal_beli'),
		'kode_admin' => $this->input->post('kode_admin'),
		'total' => $this->Pembelian_detail_model->totalall($this->uri->segment(3)),
	    );

            $this->Pembelian_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('pembelian'));
        }
        }

        $this->load->view('foot');
    }
    
    public function delete($id) 
    {
        $row = $this->Pembelian_model->selectById($id);

        if ($row) {
            $this->Pembelian_model->delete($id);
            $this->Pembelian_detail_model->deletebykey($id);
            
            redirect(site_url('pembelian'));
        }
    }
    public function struk($id){
        $row = $this->Pembelian_model->selectById($id);
        if ($row) {
            $data = array(
        'kode_beli' => $row->kode_beli,
        'tanggal_beli' => $row->tanggal_beli,
        'kode_admin' => $row->kode_admin,
        'total' => $row->total,
        'kode_suplier' => $row->kode_suplier,
        );
            $data['listbarang']=$this->Barang_model->selectByAll();
            $data['listdetail']=$this->Pembelian_detail_model->selectById($data['kode_beli']);
            $this->load->view('pembelian/struk', $data);
        } 
    }

}

/* End of file Pembelian.php */
/* Location: ./application/controllers/Pembelian.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */