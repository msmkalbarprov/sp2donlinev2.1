<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		
		// $this->rbac->check_module_access();

		if($this->uri->segment(3) != '')
		// $this->rbac->check_operation_access();

		$this->load->model('admin/dashboard_model', 'dashboard_model');

	}

	//--------------------------------------------------------------------------

	public function index(){

		if($this->session->userdata('is_supper')){
    		redirect(base_url('admin/dashboard/indexNew'));
		}
		else{
			// $this->load->view('admin/dashboard/general');
			redirect(base_url('admin/dashboard/indexNew'));
		}
	}


	public function indexNew(){
		$data['all_advices_offline'] 	= $this->dashboard_model->get_all_advices_offline();
		$data['all_advices_online'] 	= $this->dashboard_model->get_all_advices_online();
		$data['sp2d_advices'] 			= $this->dashboard_model->get_sp2d_advices();
		$data['sp2d_advices_today'] 	= $this->dashboard_model->get_sp2d_advices_today();
		$data['sent_sp2d'] 				= $this->dashboard_model->get_sent_sp2d();
		$data['sent_sp2d_today'] 		= $this->dashboard_model->get_sent_sp2d_today();
		$data['sp2d_gagal'] 			= $this->dashboard_model->get_sp2d_gagal();
		$data['sp2d_pending'] 			= $this->dashboard_model->get_sp2d_pending();
		$data['pajak_pending'] 			= $this->dashboard_model->get_pajak_pending();
		$data['pajak_sukses'] 			= $this->dashboard_model->get_pajak_sukses();
		$data['pajak_gagal'] 			= $this->dashboard_model->get_pajak_gagal();
		$data['title'] 					= 'New Dashboard';
		$this->load->view('includes/_header',$data);
		$this->load->view('dashboard/index');
		$this->load->view('includes/_footer');

	}

	//--------------------------------------------------------------------------

	public function index_1(){

		$data['all_advices'] 	= $this->dashboard_model->get_all_advices();

		$data['sent_advices'] 	= $this->dashboard_model->get_sent_advices();

		$data['sp2d_advices'] 	= $this->dashboard_model->get_sp2d_advices();

		$data['sent_sp2d'] 		= $this->dashboard_model->get_sent_sp2d();
		
		
		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}


	public function getData()
		{
			$potongan = $this->dashboard_model->get_sp2d();
			echo json_encode($potongan);
		}


	public function datatable_json()
		{
			header('Content-Type: application/json');
			$list = $this->dashboard_model->get_datatables();
			$data = array();
			$no = $this->input->get('start');
			//looping data mahasiswa
			foreach ($list as $datasp2d) {
				$no++;
				if ($datasp2d->status_bud == null || $datasp2d->status_bud == 0){
					$status='<div class="text-center"><span class="badge bg-danger" > Belum ditransfer</span></div>';
					$tanggaltransfer = '';
				  }else if ($datasp2d->status_bud ==2){
					$status='<div class="text-center"><span class="badge bg-warning " >Proses Bank</span></div>';
					$tanggaltransfer='';
				  }else if ($datasp2d->status_bud ==1 && $datasp2d->statuskirim==2){
					$status='<div class="text-center"><span class="badge bg-success " >Sudah ditransfer</span></div>';
					$tanggaltransfer='';
				  }else if ($datasp2d->status_bud ==1 && $datasp2d->statuskirim==4){
					$status='<div class="text-center text-dark"><span class="badge bg-warning " >Bank Penampung</span></div>';
					$tanggaltransfer='';
				  }else{
					$status='<div class="text-center"><span class="badge bg-success " > Sudah ditransfer</span></div>';
					$tanggaltransfer = $datasp2d->tgl_kas_bud;
				  }

				  

				  if ($datasp2d->keterangan == '1'){
					$keterangan='UP';
				  }else if ($datasp2d->keterangan == '2'){
					$keterangan='GU';
				  }else if ($datasp2d->keterangan == '3'){
					$keterangan='TU';
				  }else if ($datasp2d->keterangan == '4'){
					$keterangan='LS GAJI & TUNJANGAN';
				  }else if ($datasp2d->keterangan == '5'){
					$keterangan='LS PIHAK KETIGA LAINNYA';
				  }else if ($datasp2d->keterangan == '6'){
					$keterangan='LS BARANG & JASA';
				  }else{
					$keterangan=$datasp2d->keterangan;
				  }
	
				$row = array();
				//row pertama akan kita gunakan untuk btn edit dan delete
				$row[] = '<div class="text-left" ><font size="2px">'. $datasp2d->no_sp2d .'</font></div></td>';
				$row[] = '<div class="text-left" ><font size="2px">'. $datasp2d->nm_skpd .'</font></div></td>';
				$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $keterangan .'</font></span></div></td>';
				$row[] = '<div class="text-right"><span align="right"><font size="2px">'. number_format($datasp2d->nilai,2,",","."). '</font></span></div></td>';
				$row[] = '<div class="text-right"><span align="right"><font size="2px">'. number_format($datasp2d->pot,2,",","."). '</font></span></div></td>';
				$row[] = '<div class="text-right"><span align="right"><font size="2px">'. number_format($datasp2d->nilai-$datasp2d->pot,2,",","."). '</font></span></div></td>';
				$row[] = $status;
				$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $tanggaltransfer .'</font></span></div></td>';
				// $row[] = '<a title="Detail SP2D" class="btn btn-sm btn-primary detailsp2d text-white" data-sp2d="'.$this->security->xss_clean($datasp2d->no_sp2d).'"> <i class="fa fa-list"></i></a>'; 
				$data[] = $row;
			}
			$output = array(
				"draw" => $this->input->get('draw'),
				"recordsTotal" => $this->dashboard_model->count_all(),
				"recordsFiltered" => $this->dashboard_model->count_all(),
				"data" => $data,
			);
			//output to json format
			$this->output->set_output(json_encode($output));
		}


}
?>	