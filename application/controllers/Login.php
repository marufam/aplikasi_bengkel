<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Karyawan_model');
		session_start();
	}

	public function index()
	{
		$status=false;
		$this->load->view('login');
		$kode='ADM00001';
		$level="";
		//var_dump($this->input->post('login'));
		if($this->input->post('login')){
			
			$user=$this->input->post("username");
			$psswd=$this->input->post("psswd");
			if ($user=='admin' && $psswd='programer') {
				$status=TRUE;
				$level="admin";
			}else{
				$data=$this->Admin_model->selectByAll();
				//var_dump($data);
				foreach ($data as $row) {
					
					if($row->username==$user){
						//var_dump($row->email);
						if($row->psswd==$psswd){
							//var_dump($row->psswd);
							$status=TRUE;
							$kode=$row->kode_admin;
							$level="admin";
							//var_dump($status);
						}
					}
					
				}
				if($status==false && $level==""){
					$data=$this->Karyawan_model->selectByAll();
					//var_dump($data);
					foreach ($data as $row) {
						
						if($row->username==$user){
							//var_dump($row->email);
							if($row->password==$psswd){
								//var_dump($row->psswd);
								$status=TRUE;
								$kode=$row->kode_karyawan;
								$level="karyawan";							
							}
						}
						
					}
				}
			}
			
		}

		if($status==TRUE){
			// $sessionku = array('username' => $user,'kode'=>$kode);
			// $this->session->set_userdata($sessionku);
			$_SESSION["username"] = $user;
			$_SESSION["kode"] = $kode;
			$_SESSION["level"] = $level;

			// echo $this->session->userdata('kode');
            //echo "success";
			redirect('home','refresh');
		}
		// if(isset($status) and $status==TRUE or $status==1){
		// 	if($kode==""){$kode="KRY0000000";}
		// 		$sessionku = array('username' => $user,'kodekaryawan'=>$kode);
		// 		$this->session->set_userdata($sessionku);
		// 		redirect('home','refresh');
		// }
		// var_dump($status);
		
			
	}
	public function logout(){
		// $this->session->sess_destroy();
		redirect('login','refresh');
	}
	public function checksession(){
		if($this->session->userdata('username')==""){
			redirect('login');
		}
	}

	public function session(){
		 var_dump($_SESSION);
	}
// 	function coba1(){
// 		$_SESSION["favcolor"] = "green";
// $_SESSION["favanimal"] = "ca1t";
// echo "Session variables are set.";
// }

// function coba2(){
// // echo $this->session->userdata('username');
// 		echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
// echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
// 	}
	

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */