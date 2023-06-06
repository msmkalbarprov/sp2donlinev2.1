<?php
	class Advices_model extends CI_Model{

		// variable datatable daftar penguji
			var $table = 'trhuji'; //nama tabel dari database
			var $column_order = array(null, 'no_uji','tgl_uji','status_bank'); //field yang ada di table user
			var $column_search = array('no_uji','tgl_uji','status_bank'); //field yang diizin untuk pencarian 
			var $order = array('tgl_uji' => 'desc','nomor' => 'asc'); // default order
		// variable datatable daftar penguji

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		// datatable daftar penguji
			private function _get_datatables_query()
			{
				$status_bank = array('4');
				$this->db->select("*,cast(left(no_uji , len(no_uji)-8) as int)as nomor, 
				(select sum(nilai) from trhsp2d inner join trduji on trhsp2d.no_sp2d=trduji.no_sp2d and trduji.no_uji=trhuji.no_uji)as nilai_uji");
				$this->db->from($this->table);
				$this->db->where_not_in("status_bank", $status_bank);
				$this->db->where("sp2d_online", 1);
				// $this->db->where("no_uji", '568/AD/2023');
				$i = 0;
				foreach ($this->column_search as $item) // loop kolom 
				{
					if ($this->input->get('search')!='' && $this->input->get('search')!= null) // jika datatable mengirim POST untuk search
					{
						if ($i === 0) // looping pertama
						{
							$this->db->group_start();
							$this->db->like($item, $this->input->get('search')['value']);
						} else {
							$this->db->or_like($item, $this->input->get('search')['value']);
						}
						if (count($this->column_search) - 1 == $i) //looping terakhir
							$this->db->group_end();
					}
					$i++;
				}
		
				// jika datatable mengirim POST untuk order
				if ($this->input->get('order')) {
					$this->db->order_by($this->column_order[$this->input->get('order')['0']['column']], $this->input->get('order')['0']['dir']);
				} else if (isset($this->order)) {
					$order = $this->order;
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function get_datatables()
				{
					$this->_get_datatables_query();
					if ($this->input->get('length') != -1)
						$this->db->limit($this->input->get('length'), $this->input->get('start'));
					$query = $this->db->get();
					return $query->result();
				}

			function count_filtered()
				{
					$this->_get_datatables_query();
					$query = $this->db->get();
					return $query->num_rows();
				}
			
			public function count_all()
				{	
					$status_bank = array('4');
					$this->db->from($this->table);
					$this->db->where_not_in("status_bank", $status_bank);
					$this->db->where("sp2d_online", 1);
					return $this->db->count_all_results();
				}
		// datatable daftar penguji

		// datatable daftar penguji sukses
		private function _get_datatables_query_sukses()
		{
			$this->db->select("*,cast(left(no_uji , len(no_uji)-8) as int)as nomor,(select sum(nilai) from trhsp2d inner join trduji on trhsp2d.no_sp2d=trduji.no_sp2d and trduji.no_uji=trhuji.no_uji)as nilai_uji");
			$this->db->from($this->table);
			$this->db->where("status_bank", 4);
			$this->db->where("sp2d_online", 1);
			$this->db->order_by("nomor", 'DESC');
			$i = 0;
			foreach ($this->column_search as $item) // loop kolom 
			{
				if ($this->input->get('search')!='' && $this->input->get('search')!= null) // jika datatable mengirim POST untuk search
				{
					if ($i === 0) // looping pertama
					{
						$this->db->group_start();
						$this->db->like($item, $this->input->get('search')['value']);
					} else {
						$this->db->or_like($item, $this->input->get('search')['value']);
					}
					if (count($this->column_search) - 1 == $i) //looping terakhir
						$this->db->group_end();
				}
				$i++;
			}
	
			// jika datatable mengirim POST untuk order
			if ($this->input->get('order')) {
				$this->db->order_by($this->column_order[$this->input->get('order')['0']['column']], $this->input->get('order')['0']['dir']);
			} else if (isset($this->order)) {
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_datatables_sukses()
			{
				$this->_get_datatables_query_sukses();
				if ($this->input->get('length') != -1)
					$this->db->limit($this->input->get('length'), $this->input->get('start'));
				$query = $this->db->get();
				return $query->result();
			}

		function count_filtered_sukses()
			{
				$this->_get_datatables_query_sukses();
				$query = $this->db->get();
				return $query->num_rows();
			}
		
		public function count_all_sukses()
			{	
				$status_bank = array('4');
				$this->db->from($this->table);
				$this->db->where_in("status_bank", $status_bank);
				$this->db->where("sp2d_online", 1);
				return $this->db->count_all_results();
			}
	// datatable daftar penguji sukses



		public function get_all_advices(){
			$status = array('0', '3');
			$this->db->select('*, cast(left(no_uji , len(no_uji)-8) as int) as nomor');
			$this->db->where_not_in('status_bank' , $status);
			$this->db->where('sp2d_online' , 1);
			$this->db->order_by('status_bank','asc');
			$this->db->order_by('tgl_uji','asc');
			$this->db->order_by('nomor','asc');
			$query = $this->db->get('trhuji');
			return $result = $query->result_array();
		}

		public function get_all_sp2d_by_id($noadvices){
			$this->db->select('trduji.*,trhsp2d.tgl_sp2d,ms_rekening_bank_online.nm_rekening,ms_rekening_bank_online.nm_bank,trhsp2d.npwp,trhsp2d.nm_skpd,trhsp2d.no_rek,trhsp2d.keperluan,trhsp2d.nilai');
			$this->db->from("trduji");
			$this->db->join('trhsp2d', 'trhsp2d.no_sp2d = trduji.no_sp2d', 'left');
			$this->db->join('ms_rekening_bank_online', 'trhsp2d.no_rek = ms_rekening_bank_online.rekening and trhsp2d.kd_skpd=ms_rekening_bank_online.kd_skpd', 'left');
			$this->db->where('no_uji',$noadvices);
			$this->db->order_by("no_sp2d asc");
			$query = $this->db->get(); 
			// return $query->result_array();
			return $query ? $query->result_array() : [];
		}

		public function get_status_sp2d_by_id($id){
			$this->db->select('*');
			$this->db->from("trduji");
			$this->db->where('no_sp2d',$id);
			$query = $this->db->get(); 
			return $query->result_array();
		}
		public function get_all_potongan_by_id($nosp2d){

			$this->db->select('trspmpot.*');
			$this->db->from("trhsp2d");
			$this->db->join('trspmpot', 'trspmpot.no_spm = trhsp2d.no_spm', 'inner');
			$this->db->where('no_sp2d',$nosp2d);
			$this->db->order_by("kd_rek6 desc");
			$query = $this->db->get(); 
			return $query->result_array();
		}
		public function get_all_potongan_by_id2($nosp2d){

			$this->db->select('trspmpot.*,trdspmpot.idBilling,trdspmpot.keterangan');
			$this->db->from("trhsp2d");
			$this->db->join('trspmpot', 'trspmpot.no_spm = trhsp2d.no_spm', 'inner');
			$this->db->join('trdspmpot', 'trspmpot.no_spm = trdspmpot.nomorSPM and trspmpot.kd_rek6 = trdspmpot.kd_rek6_pajak and trspmpot.noreff = trdspmpot.noReff', 'left');
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
			$this->db->group_start();
				  	$this->db->where('status', null);
					$this->db->or_where('status <>', 2);
			$this->db->group_end();
			$this->db->update('trduji');
			return true;
		}


		public function batal($id){
			$this->db->set('status', null);
			$this->db->where('no_sp2d', $id);
			$this->db->group_start();
				  	$this->db->where('status', null);
					$this->db->or_where('status <>', 2);
			$this->db->group_end();
			$this->db->update('trduji');
			return true;
		}

		public function validasi_sp2d($id){
			$this->db->set('status', 1);
			$this->db->where('no_uji', $id);
			$this->db->group_start();
				  	$this->db->where('status', null);
					$this->db->or_where('status <>', 2);
					$this->db->or_where('status <>', 4);
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
				$this->db->or_where('status <>', 4);
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