<?php
	class Home_model extends CI_Model{

		public function add_language($data){
			return $this->db->insert('ci_language', $data);
		}

		public function get_all_jadwal(){
			$query = $this->db->get_where('tb_jadwal', array('status' => '1'));
			return $result = $query->result_array();
		}

		public function get_all_jadwal_byid(){

			$this->db->select('*');
			$this->db->from("tb_jadwal");
			$this->db->order_by("id desc");
			$query = $this->db->get(); 
			return $query->result_array();
		}

		public function get_all_potongan_by_id($nosp2d){

			$this->db->select('trspmpot.*,trdspmpot.idBilling');
			$this->db->from("trhsp2d");
			$this->db->join('trspmpot', 'trspmpot.no_spm = trhsp2d.no_spm', 'inner');
			$this->db->join('trdspmpot', 'trspmpot.no_spm = trdspmpot.nomorSPM and trspmpot.kd_rek6 = trdspmpot.kd_rek6_pajak', 'left');
			$this->db->where('no_sp2d',$nosp2d);
			$this->db->order_by("kd_rek6 desc");
			$query = $this->db->get(); 
			return $query->result_array();
		}

		public function get_detail_sp2d($id){
			ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
    		ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');
			$query = $this->db->get_where('trhsp2d', array('no_sp2d' => $id));
			return $result = $query->row_array();
		}

		public function validasi($id){
			$this->db->set('status', 1);
			$this->db->where('no_sp2d', $id);
			$this->db->update('trduji');
			return true;
		}


		public function batal($id){
			$this->db->set('status', null);
			$this->db->where('no_sp2d', $id);
			$this->db->update('trduji');
			return true;
		}

		public function validasi_sp2d($id){
			$this->db->set('status', 1);
			$this->db->where('no_uji', $id);
			$this->db->group_start();
				  	$this->db->where('status', null);
					$this->db->or_where('status <>', 2);
			$this->db->group_end();
			$this->db->update('trduji');
			return true;
		}

		public function batal_sp2d($id){
			$this->db->set('status', null);
			$this->db->where('no_uji', $id);
			$this->db->group_start();
				  $this->db->where('status', null);
				$this->db->or_where('status <>', 2);
			$this->db->group_end();
			$this->db->update('trduji');
			return true;
		}

		public function get_language_by_id($id){
			$query = $this->db->get_where('ci_language', array('id' => $id));
			return $result = $query->row_array();
		}

		public function delete_language($id) {
			$this->db->delete('ci_language', array('id' => $id));
			return true;
		}

		public function set_default_language($id){
			$language = $this->get_language_by_id($id);
			$this->db->update('ci_general_settings', array('default_language' => $language['directory_name'])); // setting in General settings table

			$this->db->update('ci_language', array('is_default' => 0)); // setting all previous to 0

			$this->db->where('id', $id);
			$this->db->update('ci_language', array('is_default' => 1));
			return true;

		}

	function terbilang($number)
	{
		if (!is_numeric($number))
		{
			return false;
		}
		
		if($number<0)
		{
			$hasil = "Minus ".trim($this->depan($number));
			$poin = trim($this->belakang($number));

		}
		else{
			$poin = trim($this->belakang($number));
			$hasil = trim($this->depan($number));
		}
   
		if($poin)
		{
			$hasil = $hasil." koma ".$poin." Rupiah";
		}
		else{
			$hasil = $hasil." Rupiah";
		}
		return $hasil;  
	}

	function  dotrek($rek){
				$nrek=strlen($rek);
				switch ($nrek) {
                case 1:
				$rek = $this->left($rek,1);								
       			 break;
    			case 2:
					$rek = $this->left($rek,1).'.'.substr($rek,1,1);								
       			 break;
    			case 4:
					$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,2);								
       			 break;
    			case 6:
					$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,2).'.'.substr($rek,4,3);								
        		break;
    			case 8:
					$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,2).'.'.substr($rek,4,2).'.'.substr($rek,6,2);								
        		break;
                case 29:
					$rek = $this->left($rek,21).'.'.substr($rek,23,1).'.'.substr($rek,24,1).'.'.substr($rek,25,1).'.'.substr($rek,26,2).'.'.substr($rek,28,2);								
        		break;
        		case 12:
					$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,2).'.'.substr($rek,4,2).'.'.substr($rek,6,2).'.'.substr($rek,8,4);								
        		break;
    			default:
				$rek = "";	
				}
				return $rek;
    }

    function belakang($number)
	{
		$number = abs($number);
		$number = stristr($number,".");
		$nomor_belakang = array("nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");

		$belakangs = "";
		$length = strlen($number);
		$i = 1;
		while($i<$length)
		{
			$get = substr($number,$i,1);
			$i++;
			$belakangs .= " ".$nomor_belakang[$get];
		}
		return $belakangs;
	}

	function depan($number)
	{
		$number = abs($number);
		$nomor_depan = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
		$depans = "";
		
		if($number<12){
			$depans = " ".$nomor_depan[$number];
		}
		else if($number<20){
			$depans = $this->depan($number-10)." belas";
		}
		else if($number<100){
			$depans = $this->depan($number/10)." puluh ".$this->depan(fmod($number,10));
		}
		else if($number<200){
			$depans = "seratus ".$this->depan($number-100);
		}
		else if($number<1000){
			$depans = $this->depan($number/100)." ratus ".$this->depan(fmod($number,100));
		//$depans = $this->depan($number/100)." Ratus ".$this->depan($number%100);
		}
		else if($number<2000){
			$depans = "seribu ".$this->depan($number-1000);
		}
		else if($number<1000000){
			$depans = $this->depan($number/1000)." ribu ".$this->depan(fmod($number,1000));
		}
		else if($number<1000000000){
			$depans = $this->depan($number/1000000)." juta ".$this->depan(fmod($number,1000000));
		}
		else if($number<1000000000000){
			$depans = $this->depan($number/1000000000)." milyar ".$this->depan(fmod($number,1000000000));
			//$depans = ($number/1000000000)." Milyar ".(fmod($number,1000000000))."------".$number;

		}
		else if($number<1000000000000000){
			$depans = $this->depan($number/1000000000000)." triliun ".$this->depan(fmod($number,1000000000000));
			//$depans = ($number/1000000000)." Milyar ".(fmod($number,1000000000))."------".$number;

		}				
		else{
			$depans = "Undefined";
		}
		return $depans;
	}

	function right($value, $count){
    return substr($value, ($count*-1));
    }

    function left($string, $count){
    return substr($string, 0, $count);
    }  

	}

?>	