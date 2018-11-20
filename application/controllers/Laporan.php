<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Penjualan_model');
		$this->load->model('Pembelian_model');
		$this->load->model('Karyawan_model');
		$this->load->model('Barang_model');
		$this->load->model('Penjualan_detail_model');
		$this->load->model('Pembelian_detail_model');
		$this->load->model('CodeGenerator');
	}
	public function beli(){
		$this->load->view('nav');
		$this->load->view('laporan/beliform');
		$this->load->view('foot');

		if($_POST){
			if($this->input->post('mulai')<>""){
				redirect('laporan/pbeli/'.date('d-m-Y',strtotime($this->input->post('mulai'))),'refresh');
			}
		}
	}
	public function pbeli($mulai){
		
		$this->load->view('nav');
		$data['listbeli']=$this->Pembelian_model->laporan($mulai);
		$data['listdetail']=$this->Pembelian_detail_model->selectByAll();
		$data['hbeli']=$this->Pembelian_model->beliByTgl($this->uri->segment(3));
		$this->load->view('laporan/pbeli', $data);
		$this->load->view('foot');
	}
	public function pbeliprint($mulai){
		$data['listbeli']=$this->Pembelian_model->laporan($mulai);
		$data['listdetail']=$this->Pembelian_detail_model->selectByAll();
		$data['hbeli']=$this->Pembelian_model->beliByTgl($this->uri->segment(3));
		$this->load->view('laporan/pbeliprint', $data);
	}

	public function jual(){
		$this->load->view('nav');
		$data['listkaryawan']=$this->Karyawan_model->selectByAll();
		$data['listgaji']=$this->Penjualan_model->gajiall(date('d-m-Y'));
		$data['semua']=$this->Penjualan_model->omsetAll();
		$data['byTgl']=$this->Penjualan_model->omsetByTgl(date('d-m-Y'));
		$data['totaltr']=$this->Penjualan_detail_model->total_rows();

		$data['totalkr']=$this->Karyawan_model->total_rows();
		if($this->uri->segment(3)==1){
			$data['pesan']="Isi data dengan lengkap";
		}
		else{
			$data['pesan']="";	
		}
		$this->load->view('laporan/jualform',$data);
		$this->load->view('foot');
		if($_POST){
			if($this->input->post('mulai')<>""){
				redirect('laporan/pjual/'.date('d-m-Y',strtotime($this->input->post('mulai'))),'refresh');
			}
		}
	}

	public function pjual($mulai){
		$this->load->view('nav');
		$data['listjual']=$this->Penjualan_model->laporan($mulai);
		$data['listdetail']=$this->Penjualan_detail_model->selectByAll();
		$data['byTgl']=$this->Penjualan_model->omsetByTgl($this->uri->segment(3));
		$data['hbeli']=$this->Penjualan_model->beliByTgl($this->uri->segment(3));
		$data['hjual']=$this->Penjualan_model->jualByTgl($this->uri->segment(3));
		$data['htotal']=$this->Penjualan_model->totalByTgl($this->uri->segment(3));
		$data['hgaji']=$this->Penjualan_model->gajiAllby($this->uri->segment(3));
		$this->load->view('laporan/pjual', $data);
		$this->load->view('foot');
	}
	public function pjualprint($mulai){
		$data['listjual']=$this->Penjualan_model->laporan($mulai);
		$data['listdetail']=$this->Penjualan_detail_model->selectByAll();
		$data['byTgl']=$this->Penjualan_model->omsetByTgl($this->uri->segment(3));
		$data['hbeli']=$this->Penjualan_model->beliByTgl($this->uri->segment(3));
		$data['hjual']=$this->Penjualan_model->jualByTgl($this->uri->segment(3));
		$data['htotal']=$this->Penjualan_model->totalByTgl($this->uri->segment(3));
		$data['hgaji']=$this->Penjualan_model->gajiAllby($this->uri->segment(3));
		$this->load->view('laporan/pjualprint', $data);
	}
	public function laporan_barang(){
		$this->load->view('nav');
		$data['listbarang']=$this->Barang_model->selectByAll();
		$this->load->view('laporan/barang', $data);
		$this->load->view('foot');
	}
	public function laporan_barangprint(){

		$data['listbarang']=$this->Barang_model->selectByAll();
		$this->load->view('laporan/barangprint', $data);
	
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */