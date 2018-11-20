<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ramal_harga extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        error_reporting(0);
        $this->load->model('Barang_model');
        $this->load->model('Pembelian_model');
        $this->load->library('form_validation');
        $this->load->model('CodeGenerator');
        $this->load->model('Merk_model');
    }
    function index(){
    	$this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'ramal_harga/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'ramal_harga/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'ramal_harga/index.html';
            $config['first_url'] = base_url() . 'ramal_harga/index.html';
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
        $this->load->view('ramal/harga_ramal', $data);
         $this->load->view('foot');
    }
    function index2(){
        $this->load->view('nav');
        $this->load->library('pagination');
        $cari = urldecode($this->input->get('cari'));
        $start = intval($this->input->get('start'));
        
        if ($cari <> '') {
            $config['base_url'] = base_url() . 'ramal_harga/index.html?cari=' . urlencode($cari);
            $config['first_url'] = base_url() . 'ramal_harga/index.html?cari=' . urlencode($cari);
        } else {
            $config['base_url'] = base_url() . 'ramal_harga/index.html';
            $config['first_url'] = base_url() . 'ramal_harga/index.html';
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
        $this->load->view('ramal/harga_ramal_uji', $data);
         $this->load->view('foot');
    }

    function peramalan($id){
    	$this->load->view('nav');
        $row = $this->Barang_model->selectById($id);

        if(isset($_POST['lihat'])){
        	$datatahun = $_POST['data_tahun'];
        	$databulan = $_POST['data_bulan'];
        	$alpha = $_POST['alpha'];
        	
	    	$data2 = $this->ramal($id, $datatahun, $databulan, $alpha);
	    	// var_dump($databulan);
        	$data = array(
				'kode_barang' => $row->kode_barang,
				'nama_barang' => $row->nama_barang,
				'kode_merk' => $row->kode_merk,
				'harga_beli' => $row->harga_beli,
				'harga_jual' => $row->harga_jual,
				'stok' => $row->stok,
				'keterangan' => $row->keterangan,
				'listdata' => $data2["data"],
				'mse_avg' => $data2["mse_avg"],
				'mae_avg' => $data2["mae_avg"]
			);
            // var_dump($data2);
            $this->load->view('ramal/harga_peramalan', $data);
        }else{
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
            $this->load->view('ramal/harga_peramalan', $data);
        } 
        }

        $this->load->view('foot');
    }


    function peramalan_uji($id){
        $this->load->view('nav');
        $row = $this->Barang_model->selectById($id);

        if(isset($_POST['lihat'])){
            $datatahun = $_POST['data_tahun'];
            $databulan = $_POST['data_bulan'];
            $alpha = $_POST['alpha'];
            // $data=$this->Pembelian_model->harga_belidata_plus($id, $datatahun);
            // for ($i=1; $i <= 12; $i++) { 
            //  foreach ($data as $data1) {
            //      $data[$i-1]= array("bulan"=>$i, "tahun"=>$data1->tahun, "jumlah"=>0 );
            //  }
            // }
            // foreach ($data as $data1) {      
            //  $data2[(int)$data1->bulan-1]= array("bulan"=>$data1->bulan, "tahun"=>$data1->tahun, "jumlah"=>$data1->jumlah );
            // }
            $data2 = $this->ramal($id, $datatahun, $databulan, $alpha);
            // var_dump($databulan);
            $data = array(
                'kode_barang' => $row->kode_barang,
                'nama_barang' => $row->nama_barang,
                'kode_merk' => $row->kode_merk,
                'harga_beli' => $row->harga_beli,
                'harga_jual' => $row->harga_jual,
                'stok' => $row->stok,
                'keterangan' => $row->keterangan,
                'listdata' => $data2["data"],
                'mse_avg' => $data2["mse_avg"],
                'mae_avg' => $data2["mae_avg"],
                'mape_avg' => $data2["mape_avg"]
                  
            );
            // var_dump($data2);
            $this->load->view('ramal/harga_peramalan_uji', $data);
        }else{
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
                $this->load->view('ramal/harga_peramalan_uji', $data);
            } 
        }

        $this->load->view('foot');


    }

    function ramal($id, $tahun, $bulan, $alpha){
    	
        $data=$this->Pembelian_model->jumlahdata_plus($id, $tahun, $bulan);
        $data_min=$this->Pembelian_model->jumlahdata_min($id, $tahun+1, $bulan);
    	
        $m=12-sizeof($data);
        for ($i=0; $i < $m; $i++) { 
            array_push($data, $data_min[$i]);
        }

  
        $i=0;
    	foreach ($data as $data1) {		
    		$data[$i]= array("bulan"=>$data1->bulan, "tahun"=>$data1->tahun, "harga_beli"=>$data1->harga_beli );
            $i++;
    	}

        $data_depan=$this->Pembelian_model->jumlahdata_plus($id, $tahun+1, $bulan);
        $data_min_depan=$this->Pembelian_model->jumlahdata_min($id, $tahun+2, $bulan);
        $m1=12-sizeof($data_depan);
        for ($i=0; $i < $m1; $i++) { 
            array_push($data_depan, $data_min_depan[$i]); //menggangubngkan dua antara datamin dan data
        }
        $i=0;
        foreach ($data_depan as $data1) {     
            $data_depan[$i]= array("bulan"=>$data1->bulan, "tahun"=>$data1->tahun, "harga_beli"=>$data1->harga_beli );
            $i++;
        }

        
    	//==============================
    	if(isset($data_depan)){
	    	for ($i=0; $i < 12; $i++) { 
	    		$awal[$i] = $data_depan[$i]['harga_beli'];
	    		if($i>0){
	    			$awal[$i] = $alpha*$awal[$i]+(1-$alpha)*$awal[$i-1];
	    		}
	    	}
	    	for ($i=0; $i < 12; $i++) { 
	    		$awal2[$i] = $awal[$i];
	    		if($i>0){
	    			$awal2[$i] = $alpha*$awal[$i]+(1-$alpha)*$awal2[$i-1];
	    		}
	    	}

	    	for ($i=0; $i < 12; $i++) { 
	    		$awal3[$i] = 2*$awal[$i]-$awal2[$i];
	    	}

	    	for ($i=0; $i < 12; $i++) { 
	    		$awal4[$i] = ($alpha/(1-$alpha))*($awal[$i]-$awal2[$i]);
	    	}

	    	for ($i=0; $i < 12; $i++) { 
	    		$awal5[$i] = $awal3[sizeof($awal3)-1]+$awal4[sizeof($awal4)-1]*($i+1);
	    	}
    	}
    	//========================
    	if(isset($data_depan)){
	    	$MAE_sum=0;
	    	$MAE_avg=0;
	    	for ($i=0; $i < 12; $i++) { 
	    		$MAE[$i] = abs($data_depan[$i]['harga_beli']-$awal5[$i]);
	    		$MAE_sum+=$MAE[$i];
	    	}
	    	$MAE_avg = $MAE_sum/sizeof($MAE);

	    	///=======================
	    	$MSE_sum=0;
	    	$MSE_avg=0;
	    	for ($i=0; $i < 12; $i++) { 
	    		$MSE[$i] = pow(($data_depan[$i]['harga_beli']-$awal5[$i]),2);
	    		$MSE_sum+=$MSE[$i];
	    	}
	    	$MSE_avg = $MSE_sum/sizeof($MSE);
    	}

    	//===================
    	if(isset($awal5)){
	    	$MAPE_sum=0;
	    	$MAPE_avg=0;
	    	for ($i=0; $i < 12; $i++) { 
	    		$MAPE[$i] = abs(($awal5[$i]-$data_depan[$i]['harga_beli'])/$data_depan[$i]['harga_beli']);
	    		$MAPE_sum+=$MAPE[$i];
	    	}
	    	$MAPE_avg = $MAPE_sum/sizeof($MAPE);

	    	//=======================
	    	for ($i=0; $i < 12; $i++) { 
	    		$data[$i]['ril'] = $data[$i]['harga_beli'];
                $data[$i]['tahun_yang_diramal'] = $data_depan[$i]['harga_beli'];
	    		$data[$i]['ramal'] = $awal5[$i];
	    		$data[$i]['MAE'] = $MAE[$i];
	    		$data[$i]['MSE'] = $MSE[$i];
	    		$data[$i]['MAPE'] = $MAPE[$i];

	    	}
	    	$dataku = array('data' => $data, 'mae_avg' => $MAE_avg, 'mse_avg'=> $MSE_avg, 'mape_avg'=> $MAPE_avg);
            // var_dump($data);   
    	}else{
    		$dataku =array('data' => null, 'mae_avg' => null, 'mse_avg'=> null, 'mape_avg'=> null);
    	}
    	// var_dump($dataku);
    	// var_dump($awal);
    	// var_dump($awal2);
    	// var_dump($awal3);
    	// var_dump($awal4);
    	// var_dump($awal5);
    	// var_dump($MAE);
    	// var_dump($MSE_avg);
    	return $dataku;
    }
    	
    	
    
}
