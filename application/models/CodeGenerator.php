
<?php
//created maruf 14/06/2016
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeGenerator extends CI_Model {

	public function buatkode($table,$field, $panjang, $inisial){
		
		$sql=$this->db->query("select max(".$field.") as $field from ".$table)->result();
		//var_dump($sql[0]->noktp);
		// $row=mysql_fetch_array($sql);
		
		if ($sql[0]->$field==""){
				$angka="0";
		 	}else{
			
		 		$angka=substr($sql[0]->$field,strlen($inisial));
		 	}
		//return $angka;
		$angka++;
		$angka=strval($angka);
		$tmp="";
		for ($i=1; $i<=($panjang-strlen($angka)-strlen($inisial));$i++){
			$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka ;
	}	
	function rp($angka){	$angka = number_format($angka);	$angka = str_replace(',', '.', $angka);	$angka ="$angka";	return $angka;}

}

/* End of file CodeGenerator.php */
/* Location: ./application/models/CodeGenerator.php */