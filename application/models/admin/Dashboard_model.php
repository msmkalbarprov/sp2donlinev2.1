<?php
	class Dashboard_model extends CI_Model{

		var $column_order = array(null, 'no_sp2d','tgl_sp2d','keterangan','nmrekan','nilai'); //field yang ada di table user
    	var $column_search = array('no_sp2d','tgl_sp2d','keterangan','nm_skpd','nilai'); //field yang diizin untuk pencarian 
    	var $order = array('tgl_sp2d' => 'desc'); // default order

		public function get_all_advices_offline(){
			$this->db->where('sp2d_online', 0);
			return $this->db->count_all_results('trhuji');
		}
		public function get_all_advices_online(){
			$this->db->where('sp2d_online', 1);
			return $this->db->count_all_results('trhuji');
		}
		public function get_sp2d_advices(){
			$this->db->where('sp2d_batal<>', 1);
			$this->db->or_where('sp2d_batal', null);
			return $this->db->count_all_results('trhsp2d');
		}

		public function get_sp2d_advices_today(){
			$date=  date('Y-m-d');
			$this->db->group_start();
				$this->db->where('sp2d_batal<>', 1);
				$this->db->or_where('sp2d_batal', null);
			$this->db->group_end();
			$this->db->where('tgl_kas_bud', $date);
			return $this->db->count_all_results('trhsp2d');
		}

		public function get_sent_sp2d(){
			$this->db->where('status_bud', 1);
			return $this->db->count_all_results('trhsp2d');
		}

		public function get_sent_sp2d_today(){
			$date=  date('Y-m-d');
			$this->db->where('status_bud', 1);
			$this->db->where('tgl_kas_bud', $date);
			return $this->db->count_all_results('trhsp2d');
		}

		public function get_sp2d_gagal(){
			$this->db->where('status', 3);
			return $this->db->count_all_results('trduji');
		}

		public function get_sp2d_pending(){
			$this->db->where('status', 4);
			return $this->db->count_all_results('trduji');
		}

		public function get_pajak_pending(){
			$this->db->where('keterangan', 'Transaksi Pending');
			return $this->db->count_all_results('trspmpot');
		}
		public function get_pajak_sukses(){
			$this->db->where('keterangan', 'SUKSES');
			return $this->db->count_all_results('trspmpot');
		}
		public function get_pajak_gagal(){
			$this->db->where('keterangan', 'Error - Invalid payload request');
			return $this->db->count_all_results('trspmpot');
		}

		public function get_sp2d(){
			$this->db->select('sum(case when month(tgl_kas_bud)=1 then nilai else 0 end) as januari,
							   sum(case when month(tgl_kas_bud)=2 then nilai else 0 end) as februari,
							   sum(case when month(tgl_kas_bud)=3 then nilai else 0 end) as maret,
							   sum(case when month(tgl_kas_bud)=4 then nilai else 0 end) as april,
							   sum(case when month(tgl_kas_bud)=5 then nilai else 0 end) as mei,
							   sum(case when month(tgl_kas_bud)=6 then nilai else 0 end) as juni,
							   sum(case when month(tgl_kas_bud)=7 then nilai else 0 end) as juli,
							   sum(case when month(tgl_kas_bud)=8 then nilai else 0 end) as agustus,
							   sum(case when month(tgl_kas_bud)=9 then nilai else 0 end) as september,
							   sum(case when month(tgl_kas_bud)=10 then nilai else 0 end) as oktober,
							   sum(case when month(tgl_kas_bud)=11 then nilai else 0 end) as november,
							   sum(case when month(tgl_kas_bud)=12 then nilai else 0 end) as desember,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=1) as tot1,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=2) as tot2,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=3) as tot3,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=4) as tot4,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=5) as tot5,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=6) as tot6,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=7) as tot7,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=8) as tot8,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=9) as tot9,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=10) as tot10,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=11) as tot11,
							   (select count(*) from trhsp2d where month(tgl_kas_bud)=12) as tot12');
			$this->db->where('status_bud', 1);
			$this->db->from('trhsp2d');
			// $this->db->group_by('month(tgl_kas_bud)');
			return $this->db->get()->row_array();
		}

		function get_datatables()
		{
			$this->_get_datatables_query();
			if ($this->input->get('length') != -1)
				$this->db->limit($this->input->get('length'), $this->input->get('start'));
			$query = $this->db->get();
			return $query->result();
		}

		private function _get_datatables_query()
		{
			
			$this->db->from("v_sp2donline");
			$this->db->order_by("CAST(SUBSTRING(no_sp2d,0,LEN(no_sp2d)-8) as int) DESC");
			$this->db->order_by("urut ASC");
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

		function count_filtered()
		{
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all()
		{
			$this->db->from("v_sp2donline");
			return $this->db->count_all_results();
		}
		
	}

?>
