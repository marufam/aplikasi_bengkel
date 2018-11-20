<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penjualan_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        $this->load->model('Karyawan_model');
        $this->load->model('Barang_model');
        $this->load->model('Penjualan_detail_model');
        session_start();
    }
     public function _rule() 
    {
	$this->form_validation->set_rules('kode_jual', 'kode jual', 'trim|required');
	$this->form_validation->set_rules('tanggal_jual', 'tanggal jual', 'trim|required');
	$this->form_validation->set_rules('kode_admin', 'kode admin', 'trim|required');
	//$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
	//$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('ongkos_karyawan', 'ongkos karyawan', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('bayar', 'bayar', 'trim|required');
    }

    public function index()
    {
         $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'penjualan/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'penjualan/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'penjualan/index.html';
            $config['first_url'] = base_url() . 'penjualan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penjualan_model->total_rows($cari);
        $penjualan = $this->Penjualan_model->get_limit_data($config['per_page'], $start, $cari);

        
        $this->pagination->initialize($config);

        $data = array(
            'penjualan_data' => $penjualan,
            'cari' => $cari,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('penjualan/penjualan_list', $data);
         $this->load->view('foot');
    }

    public function view($id) 
    {
        $this->load->view('nav');
        $row = $this->Penjualan_model->selectById($id);
        if ($row) {
            $data = array(
		'kode_jual' => $row->kode_jual,
		'tanggal_jual' => $row->tanggal_jual,
		'kode_admin' => $row->kode_admin,
		'kode_karyawan' => $row->kode_karyawan,
		'keterangan' => $row->keterangan,
		'ongkos_karyawan' => $row->ongkos_karyawan,
		'total' => $row->total,
		'bayar' => $row->bayar,
        'pelanggan' => $row->pelanggan,
	    );
            $data['listkaryawan']=$this->Karyawan_model->selectByAll();
        $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Penjualan_detail_model->selectById($data['kode_jual']);
            $this->load->view('penjualan/penjualan_read', $data);
        } 
        $this->load->view('foot');
    }

    public function datainsert() 
    {
        $this->load->view('nav');
        // echo $this->session->userdata('kode');
        $data = array(
           
	    'kode_jual' => set_value('kode_jual',$this->CodeGenerator->buatkode('penjualan','kode_jual',10,'TRJ')),
	    'tanggal_jual' => set_value('tanggal_jual', date('d-m-Y')),
	    'kode_admin' => set_value('kode_admin', $_SESSION['kode']),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'keterangan' => set_value('keterangan'),
	    'ongkos_karyawan' => set_value('ongkos_karyawan',0),
	    'total' => set_value('total',$this->Penjualan_detail_model->totalall($this->CodeGenerator->buatkode('penjualan','kode_jual',10,'TRJ'))),
	    'bayar' => set_value('bayar',$this->Penjualan_detail_model->totalall($this->CodeGenerator->buatkode('penjualan','kode_jual',10,'TRJ'))),
        'pelanggan' => set_value('pelanggan'),
	);
        $data['listkaryawan']=$this->Karyawan_model->selectByAll();
        $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Penjualan_detail_model->selectById($data['kode_jual']);
        $this->load->view('penjualan/penjualan_form', $data);
        $this->load->view('foot');
    }
    
    public function insert() 
    {
        // var_dump($this->input->post('cetak')=="on");
        // if( $this->input->post('cetak')=="on"){
            
        //     echo '<script>window.open("http://localhost/solokuro/login")</script>';
        //     echo '<meta http-equiv="refresh" content="0">';
        // }else{
        //     redirect(site_url('home'));
        // }

        $total=0;
        
        if($this->input->post('submitlist')<>""){
            if($this->input->post('jumlah')<>""){
                $cek=$this->Penjualan_detail_model->jumlahbyid($this->input->post('kode_jual'), $this->input->post('kode_barang'));
                //var_dump($cek);
                if($cek==0){
                    $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                    if($barang->stok>=$this->input->post('jumlah')){
                    $data=array(
                        'kode_jual' => $this->input->post('kode_jual'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_jual' => $barang->harga_jual,
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_jual*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Penjualan_detail_model->insert($data);  
                    if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                        redirect(site_url('home'),'refresh');
                    } else{
                        redirect(site_url('penjualan/insert'),'refresh');
                    }
                    
                    }else{
                        echo "<script>alert('Stok kurang')</script>";
                         if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                        redirect(site_url('home'),'refresh');
                    } else{
                        redirect(site_url('penjualan/insert'),'refresh');
                    }
                    }
                }else{
                     $barang=$this->Barang_model->selectById($this->input->post('kode_barang'));
                    //var_dump($barang);
                     if($barang->stok>$this->input->post('jumlah')){
                    $data=array(
                        'kode_jual' => $this->input->post('kode_jual'),
                        'kode_barang'=> $this->input->post('kode_barang'),
                        'harga_jual' => $barang->harga_jual,
                        'harga_beli'=> $barang->harga_beli,
                        'jumlah'=>$this->input->post('jumlah'),
                        'subtotal'=> (int)$barang->harga_jual*(int)$this->input->post('jumlah'),
                        );
                    
                    $this->Penjualan_detail_model->update($data['kode_jual'],$data['kode_barang'],$data);   
                     if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                        redirect(site_url('home'),'refresh');
                    } else{
                        redirect(site_url('penjualan/insert'),'refresh');
                    }
                }else{
                        echo "<script>alert('Stok kurang')</script>";
                    if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                        redirect(site_url('home'),'refresh');
                    } else{
                        redirect(site_url('penjualan/insert'),'refresh');
                    }
                    }
                }
            }
        }else{
            // echo $this->uri->segment(3);
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                echo "<script>alert('isi data dengan lengkap!!')</script>";
                redirect(site_url('home'),'refresh');
            } else{
                redirect(site_url('penjualan/insert'),'refresh');
            }
            // $this->datainsert();
        } else {
            $data = array(
		'kode_jual' => $this->input->post('kode_jual'),
		'tanggal_jual' => $this->input->post('tanggal_jual'),
		'kode_admin' => $this->input->post('kode_admin'),
		'kode_karyawan' => $this->input->post('kode_karyawan'),
		'keterangan' => $this->input->post('keterangan'),
		'ongkos_karyawan' => $this->input->post('ongkos_karyawan'),
		'total' => $this->Penjualan_detail_model->totalall($this->input->post('kode_jual'))+(int)$this->input->post('ongkos_karyawan'),
		'bayar' => $this->Penjualan_detail_model->totalall($this->input->post('kode_jual'))+(int)$this->input->post('ongkos_karyawan'),
        'pelanggan' => $this->input->post('pelanggan'),
	    );
             $this->Penjualan_detail_model->updatestok($this->input->post('kode_jual'));
            $this->Penjualan_model->insert($data);
            if($this->uri->segment(3)<>"" and $this->uri->segment(3)==1){
                        if( $this->input->post('cetak')=="on"){
                            echo "<script type='text/javascript' language='javascript'>window.open('".base_url().'penjualan/struk/'.$this->input->post('kode_jual')."')</script>";
                            echo '<meta http-equiv="refresh" content="0;url=http://localhost/solokuro/index.php/home.html">';
                        }else{
                            redirect(site_url('home'),'refresh');
                        }
                    } else{
                        redirect(site_url('penjualan'),'refresh');
                    }
        }
    }

    }
    
    public function dataupdate($id) 
    {
        $this->load->view('nav');
        $row = $this->Penjualan_model->selectById($id);

        if ($row) {
            $data = array(
                
		'kode_jual' => set_value('kode_jual', $row->kode_jual),
		'tanggal_jual' => set_value('tanggal_jual', $row->tanggal_jual),
		'kode_admin' => set_value('kode_admin', $row->kode_admin),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'ongkos_karyawan' => set_value('ongkos_karyawan', $row->ongkos_karyawan),
		'total' => set_value('total', $row->total),
		'bayar' => set_value('bayar', $row->bayar),
        'pelanggan' => set_value('pelanggan', $row->pelanggan),
	    );
            $this->load->view('penjualan/penjualan_form', $data);
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
		'tanggal_jual' => $this->input->post('tanggal_jual'),
		'kode_admin' => $this->input->post('kode_admin'),
		'kode_karyawan' => $this->input->post('kode_karyawan'),
		'keterangan' => $this->input->post('keterangan'),
		'ongkos_karyawan' => $this->input->post('ongkos_karyawan'),
		'total' => $this->Penjualan_detail_model->totalall($this->input->post('kode_jual')),
		'bayar' => $this->input->post('bayar'),
        'pelanggan' => $this->input->post('pelanggan'),
	    );

            $this->Penjualan_model->update($this->uri->segment(3), $data);
            
            redirect(site_url('penjualan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penjualan_model->selectById($id);

        if ($row) {
            $this->Penjualan_model->delete($id);
            $this->Penjualan_detail_model->deletebykey($id);
            redirect(site_url('penjualan'));
        }
    }
    public function struk($id){
        $row = $this->Penjualan_model->selectById($id);
        if ($row) {
            $data = array(
        'kode_jual' => $row->kode_jual,
        'tanggal_jual' => $row->tanggal_jual,
        'kode_admin' => $row->kode_admin,
        'kode_karyawan' => $row->kode_karyawan,
        'keterangan' => $row->keterangan,
        'ongkos_karyawan' => $row->ongkos_karyawan,
        'total' => $row->total,
        'bayar' => $row->bayar,
        'pelanggan' => $row->pelanggan,
        );
            $data['listkaryawan']=$this->Karyawan_model->selectByAll();
        $data['listbarang']=$this->Barang_model->selectByAll();
        $data['listdetail']=$this->Penjualan_detail_model->selectById($data['kode_jual']);
            $this->load->view('penjualan/struk', $data);
        } 
    }

}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
/*  2016-07-29 19:31:02 */
/* Computer : Maruf */