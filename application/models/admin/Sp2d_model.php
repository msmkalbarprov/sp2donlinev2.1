<?php
	class Sp2d_model extends CI_Model{

	var $table = 'trhsp2d'; //nama tabel dari database
    var $column_order = array(null, 'no_sp2d','tgl_sp2d','keperluan','nmrekan','nilai'); //field yang ada di table user
    var $column_search = array('no_sp2d','tgl_sp2d','keperluan','nm_skpd','nilai'); //field yang diizin untuk pencarian 
    var $order = array('tgl_sp2d' => 'desc'); // default order
	
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function add_language($data){
			return $this->db->insert('ci_language', $data);
		}

		public function formatbilling($billing)
		{
			$id = substr($billing,0,4).'  '.substr($billing,4,4).'   '.substr($billing,8,4).'   '.substr($billing,12,3);
			return $id;
		}

		

		private function _get_datatables_query()
		{
			$this->db->select('trhsp2d.*,(SELECT TOP 1 nm_rekening from ms_rekening_bank_online where trhsp2d.no_rek=rekening)as penerima');
			$this->db->from($this->table);
			$this->db->group_start();
				$this->db->where("is_verified", 0);
				$this->db->or_where("is_verified", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("sp2d_batal", 0);
				$this->db->or_where("sp2d_batal", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("status_bud <>", 1);
				$this->db->or_where("status_bud", null);
			$this->db->group_end();
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

		private function _get_datatables_query2()
		{
			$this->db->from($this->table);
			$this->db->where_in("is_verified", array('1','3'));
			$this->db->group_start();
				$this->db->where("status_bud <>", 1);
				$this->db->or_where("status_bud", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("sp2d_batal", 0);
				$this->db->or_where("sp2d_batal", null);
			$this->db->group_end();
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

		private function _get_datatables_query3()
		{
			$this->db->from($this->table);
			$this->db->where("status_bud", 1);
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

		function get_datatables2()
		{
			$this->_get_datatables_query2();
			if ($this->input->get('length') != -1)
				$this->db->limit($this->input->get('length'), $this->input->get('start'));
			$query = $this->db->get();
			return $query->result();
		}

		function get_datatables3()
		{
			$this->_get_datatables_query3();
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

		function count_filtered2()
		{
			$this->_get_datatables_query2();
			$query = $this->db->get();
			return $query->num_rows();
		}

		function count_filtered3()
		{
			$this->_get_datatables_query3();
			$query = $this->db->get();
			return $query->num_rows();
		}
	
		public function count_all()
		{
			$this->db->from($this->table);
			$this->db->group_start();
				$this->db->where("is_verified", 0);
				$this->db->or_where("is_verified", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("status_bud <>", 1);
				$this->db->or_where("status_bud", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("sp2d_batal", 0);
				$this->db->or_where("sp2d_batal", null);
			$this->db->group_end();

			return $this->db->count_all_results();
		}

		public function count_all2()
		{
			$this->db->from($this->table);
			$this->db->where("is_verified", 1);
			$this->db->group_start();
				$this->db->where("sp2d_batal", 0);
				$this->db->or_where("sp2d_batal", null);
			$this->db->group_end();
			$this->db->group_start();
				$this->db->where("status_bud <>", 1);
				$this->db->or_where("status_bud", null);
			$this->db->group_end();
			return $this->db->count_all_results();
		}

		public function count_all3()
		{
			$this->db->from($this->table);
			$this->db->where("status_bud", 1);
			return $this->db->count_all_results();
		}


		public function get_all_sp2d_verified(){
			$this->db->from("trhsp2d");
            $this->db->where("is_verified", 0);
            $this->db->or_where("is_verified", null);
            $query = $this->db->get();
			return $result = $query->result_array();
		}

		public function get_all_sp2d_by_id($noadvices){
			$this->db->select('trduji.*,trhsp2d.tgl_sp2d,ms_rekening_bank_online.nm_rekening,trhsp2d.npwp,trhsp2d.no_rek,trhsp2d.keperluan,trhsp2d.nilai');
			$this->db->from("trduji");
			$this->db->join('trhsp2d', 'trhsp2d.no_sp2d = trduji.no_sp2d', 'left');
			$this->db->join('ms_rekening_bank_online', 'trhsp2d.no_rek = ms_rekening_bank_online.rekening and trhsp2d.kd_skpd=ms_rekening_bank_online.kd_skpd', 'left');
			$this->db->where('no_uji',$noadvices);
			$this->db->order_by("no_sp2d desc");
			$query = $this->db->get(); 
			return $query->result_array();
		}

		public function get_status_sp2d_by_id($id){
			$this->db->select('*');
			$this->db->from("trduji");
			$this->db->where('no_sp2d',$id);
			$query = $this->db->get(); 
			return $query->result_array();
		}
		public function get_all_potongan_by_id($nosp2d){

			$this->db->select('trspmpot_test.*');
			$this->db->from("trhsp2d");
			$this->db->join('trspmpot_test', 'trspmpot_test.no_spm = trhsp2d.no_spm', 'inner');
			$this->db->where('no_sp2d',$nosp2d);
			$this->db->order_by("kd_rek6 desc");
			$query = $this->db->get(); 
			return $query->result_array();
		}
		public function get_all_potongan_by_id2($nosp2d){

			$this->db->select('trspmpot_test.*,trdspmpot.idBilling,trdspmpot.keterangan');
			$this->db->from("trhsp2d");
			$this->db->join('trspmpot_test', 'trspmpot_test.no_spm = trhsp2d.no_spm', 'inner');
			$this->db->join('trdspmpot', 'trspmpot_test.no_spm = trdspmpot.nomorSPM and trspmpot_test.kd_rek6 = trdspmpot.kd_rek6_pajak and trspmpot_test.noreff = trdspmpot.noReff', 'left');
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


		public function get_no_kas_bud() {
			// $this->db->select_max('no_kas_bud');
			// $this->db->where('status_bud', 1);
			// $res1 = $this->db->get('trhsp2d');
			
			$this->db->select_max('cast(no_kas_bud as int)', 'max');
			$this->db->where('status_bud', 1);
			$query = $this->db->get('trhsp2d');
			$max = $query->row()->max;
				if($max == 0){
					$next_id = 1;
				}else{
					$next_id = $max+1;
				}
				return $next_id;
			
		}

		function TotalPotongan($nosp2d)
		{	
			$query2 		= "select no_spm from trhsp2d where no_sp2d='$nosp2d'";
			$hasil2 		= $this->db->query($query2);
			$nospm 			= $hasil2->row('no_spm');
						
			$this->db->select('sum(nilai)as potongan');
			$this->db->from("trspmpot");
			$this->db->where("no_spm",$nospm);
			$query=$this->db->get();
			return $query;
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