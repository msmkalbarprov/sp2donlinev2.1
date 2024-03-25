<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TukdBank extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/advices_model', 'advices_model');
		$this->load->model('admin/Sp2d_model', 'sp2d_model');
	}
public function controller_method( )
{
    try
    {
        // normal flow
    }
    catch( Exception $e )
    {
        log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
        // on error
    }
}

	public function setting()
	{	$data['all_service'] = $this->advices_model->get_all_service();
		$data['title'] = 'Service SP2D Online';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/sp2donline/services', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function index()
	{	$data['all_advices'] = $this->advices_model->get_all_advices();
		$data['title'] = 'Payment';
		$this->load->view('includes/_header', $data);
		$this->load->view('daftarPenguji/index', $data);
		$this->load->view('includes/_footer', $data);
	}
	// NEW
	public function Newindex()
	{	$data['all_advices'] = $this->advices_model->get_all_advices();
		$data['title'] = 'Payment SP2d';
		$this->load->view('includes/_header', $data);
		$this->load->view('daftarPenguji/index', $data);
		$this->load->view('includes/_footer', $data);
	}

	public function datatable_json()
    {
        header('Content-Type: application/json');
        $list = $this->advices_model->get_datatables();
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $dataPenguji) {
            $no++;

			if ($dataPenguji->status_bank == null || $dataPenguji->status_bank == 0){
				$status='<div class="text-center"><span class="badge bg-dark" > Belum Verifikasi</span></div>';
				$status2="Belum Verifikasi";
			  }else if ($dataPenguji->status_bank =='1'){
				$status='<div class="text-center"><span class="badge bg-primary" > Terverifikasi</span></div>';
				$status2="Terverifikasi";
			  }else if ($dataPenguji->status_bank =='2'){
				$status='<div class="text-center"><span class="badge bg-warning" > Proses Bank</span></div>';
				$status2="Proses Bank";
			  }else if ($dataPenguji->status_bank =='3'){
				$status='<div class="text-center"><span class="badge bg-danger" > Batal</span></div>';
				$status2="Batal";
			  }else if ($dataPenguji->status_bank =='4'){
				$status='<div class="text-center"><span class="badge bg-success" > SUKSES</span></div>';
				$status2="SUKSES";
			  }else{
				$status='<div class="text-center"><span class="badge bg-warning" >Tidak Ada Keterangan</span></div>';
				$status2="Tidak Ada Keterangan";
			  }

            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-center"><span align="left"><font size="2px">'. $dataPenguji->no_uji .'</font></span></div></td>';
            $row[] = '<div class="text-center"><span align="left"><font size="2px">'. $dataPenguji->tgl_uji .'</font></span></div></td>';
			$row[] = $status;
			$row[] = '<div class="text-center"><a title="Detail Penguji" class="btn btn-sm btn-success detail text-white" 
			data-no_uji="'.htmlspecialchars($dataPenguji->no_uji).'" 
			data-nilai_uji="'.htmlspecialchars($dataPenguji->nilai_uji).'" 
			data-status_bank="'.htmlspecialchars($status2).'" 
			data-tgl_uji="'.htmlspecialchars($dataPenguji->tgl_uji).'"> <i class="fa fa-list"></i></a></div>'; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->advices_model->count_all(),
            "recordsFiltered" => $this->advices_model->count_all(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

	public function datatable_json_sukses()
    {
        header('Content-Type: application/json');
        $list = $this->advices_model->get_datatables_sukses();
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $dataPenguji) {
            $no++;

			if ($dataPenguji->status_bank == null || $dataPenguji->status_bank == 0){
				$status='<div class="text-center"><span class="badge bg-info" > Belum Verifikasi</span></div>';
				$status2="Belum Verifikasi";
			  }else if ($dataPenguji->status_bank =='1'){
				$status='<div class="text-center"><span class="badge bg-primary" > Terverifikasi</span></div>';
				$status2="Terverifikasi";
			  }else if ($dataPenguji->status_bank =='2'){
				$status='<div class="text-center"><span class="badge bg-warning" > Proses Bank</span></div>';
				$status2="Proses Bank";
			  }else if ($dataPenguji->status_bank =='3'){
				$status='<div class="text-center"><span class="badge bg-danger" > Batal</span></div>';
				$status2="Batal";
			  }else if ($dataPenguji->status_bank =='4'){
				$status='<div class="text-center"><span class="badge bg-success" > SUKSES</span></div>';
				$status2="SUKSES";
			  }else{
				$status='<div class="text-center"><span class="badge bg-warning" >Tidak Ada Keterangan</span></div>';
				$status2="Tidak Ada Keterangan";
			  }
			  $newdate = ($dataPenguji->tgl_kirim == '' ? $dataPenguji->tgl_cair : date("Y-m-d H:i:s", strtotime($dataPenguji->tgl_kirim)));
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-center"><span align="left"><font size="2px">'. $dataPenguji->no_uji .'</font></span></div></td>';
            $row[] = '<div class="text-center"><span align="left"><font size="2px">'. $newdate .'</font></span></div></td>';
			$row[] = $status;
			$row[] = '<div class="text-center"><a title="Detail Penguji" class="btn btn-sm btn-success detail text-white" 
						data-no_uji="'.htmlspecialchars($dataPenguji->no_uji).'" 
						data-status_bank="'.htmlspecialchars($status2).'" 
						data-nilai_uji="'.htmlspecialchars($dataPenguji->nilai_uji).'" 
						data-tgl_uji="'.htmlspecialchars($dataPenguji->tgl_uji).'"> 
						<i class="fa fa-list"></i></a></div>'; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->advices_model->count_all_sukses(),
            "recordsFiltered" => $this->advices_model->count_all_sukses(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }
	// END NEW
	
public function datatable_sp2d(){		
		if($this->input->get('noadvices')!=''){
			$noadvices= $this->input->get('noadvices');
		 }
		 else{
			$noadvices=0;
		 }
		
		$records['data'] = $this->advices_model->get_all_sp2d_by_id($noadvices);
		
		$this->db->from('trduji');
		$this->db->like('no_uji', $noadvices);
		$total_record = $this->db->count_all_results(null, false);
		$this->db->like('no_uji', $noadvices);
		$total_filtered = $this->db->count_all_results(null, false);
		// $data = $this->db->get()->result();
		

		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if($row['status']==null){
				$status='<span class="badge bg-warning">Belum validasi</span>';
			}else if($row['status']==0 || $row['status']=='0' || $row['status']==''){
				$status='<span class="badge bg-danger">gagal Kirim</span>';
			}else if($row['status']==1){
				$status='<span class="badge bg-primary">Siap Kirim</span>';
			}else if($row['status']==2){
				$status='<span class="badge bg-success">Cair</span>';
			}else if($row['status']==4){
				$status='<span class="badge bg-warning">Pending</span>';
			}else{
				$status='<span class="badge bg-danger">Gagal Kirim</span>';
			}

			$data[]= array(
				++$i,
				'<div><span align="left"><font size="2px">'.$this->security->xss_clean($row['no_sp2d']) .'<br>'.$this->security->xss_clean($row['tgl_sp2d']).'</font></span></div></td>',
				$this->security->xss_clean($row['nm_skpd']),
				'<div><span align="left"><font size="2px">- '.$this->security->xss_clean($row['nm_rekening']) .'<br>- '.$this->security->xss_clean($row['no_rek']).'<br>- '.$this->security->xss_clean($row['npwp']).'</font></span></div></td>',
				'<div align="right">'.$this->security->xss_clean(number_format($row['nilai'],'2','.',',')).'</div>',
				'<div class="text-center">'.$this->security->xss_clean($status).'</div>',
				'<div class="text-center">
					<a title="Detail SP2D" class="btn btn-sm btn-primary detailsp2d text-white" 
					data-sp2det="'.$this->security->xss_clean($row['no_sp2d']).'" 
					data-tgl_sp2d="'.$this->security->xss_clean($row['tgl_sp2d']).'" 
					data-nilai_bruto="'.$this->security->xss_clean(number_format($row['nilai'],'2','.',',')).'" 
					data-nm_skpd="'.$this->security->xss_clean($row['nm_skpd']).'" 
					data-penerima="'.$this->security->xss_clean($row['nm_rekening']).'"
					data-norek_penerima="'.$this->security->xss_clean($row['no_rek']).'"
					data-npwp="'.$this->security->xss_clean($row['npwp']).'"
					data-nm_bank_penerima="'.$this->security->xss_clean($row['nm_bank']).'"
					data-sp2ket="'.$row['keperluan'].'" 
					data-sp2stat="'.$this->security->xss_clean($row['ket_payment']).'
				"> 
				<i class="fa fa-list"></i></a>
				<a title="Informasi SP2D" class="btn btn-sm btn-info infosp2d text-white" 
					data-modsp2d="'.$this->security->xss_clean($row['no_sp2d']).'" 
					data-modstat="'.$this->security->xss_clean($row['status']).'"
				"> 
				<i class="fa fa-info"></i></a>
				
				</div>',
				

			);
		}
		// $records['data']=$data;
		echo json_encode(array(
			// 'draw' => $_POST['draw'],
			'recordsTotal' => $total_record,
			'recordsFiltered' => $total_filtered,
			'data' => $data,
		));
		// echo json_encode($records);						   
	}


public function datatable_potongan(){		
		$nosp2d= $this->input->get('nosp2ddet');
		$records['data'] = $this->advices_model->get_all_potongan_by_id($nosp2d);
		
		$this->db->from('trspmpot');
		$this->db->join('trhsp2d', 'trspmpot.no_spm=trhsp2d.no_spm','inner');
		$this->db->like('no_sp2d', $nosp2d);
		$total_record = $this->db->count_all_results(null, false);
		// $this->db->like('no_uji', $nosp2d);
		$total_filtered = $this->db->count_all_results(null, false);
		$data = $this->db->get()->result();

		$data = array();
		$i=0;
		foreach ($records['data'] as $row) 
		{  

			if ($row['keterangan']=='SUKSES' || $row['keterangan']=='Sukses'){
					$keterangan='<span class="badge bg-success">'.$this->security->xss_clean($row['keterangan']).'</span>';
				}else if ($row['keterangan']=='Transaksi Pending'){
					$keterangan='<span class="badge bg-warning">'.$this->security->xss_clean($row['keterangan']).'</span>';
				}else{
					$keterangan='<span class="badge bg-danger">'.$this->security->xss_clean($row['keterangan']).'</span>';
				}

			$data[]= array(
				++$i,
				$this->security->xss_clean($row['kd_rek6']),
				$this->security->xss_clean($row['nm_rek6']),
				$this->security->xss_clean(number_format($row['nilai'],'2','.',',')),
				$this->security->xss_clean($row['idBilling']),
				$this->security->xss_clean($row['ntpn']),
				$keterangan
			);
		}
		echo json_encode(array(
			// 'draw' => $_POST['draw'],
			'recordsTotal' => $total_record,
			'recordsFiltered' => $total_filtered,
			'data' => $data,
		));					   
	}
public function validasi()
	{
		$id = $this->input->post('nosp2d');
		$records['data'] = $this->advices_model->get_status_sp2d_by_id($id);
		foreach ($records['data']   as $row) 
		{
			$status=$row['status'];
			if ($status==null || $status=='3' || $status=='1' || $status=='0'){
				$result = $this->advices_model->validasi($id);
				if ($result) {
					$status=["status"=>1];
					echo json_encode($status);
				} else {
					$status=["status"=>0];
					echo json_encode($status);
				}
			}else{
				$status=["status"=>2];
					echo json_encode($status);
			}
			

		}

		
		// redirect(base_url('admin/languages'));
	}

public function batal()
	{
		$id = $this->input->post('nosp2d');
		$records['data'] = $this->advices_model->get_status_sp2d_by_id($id);
		foreach ($records['data']   as $row) 
		{
			$status=$row['status'];
			if ($status==null || $status=='3' || $status=='1' || $status=='0'){
				$result = $this->advices_model->batal($id);
				if ($result) {
					$status=["status"=>1];
					echo json_encode($status);
				} else {
					$status=["status"=>0];
					echo json_encode($status);
				}
			}else{
				$status=["status"=>2];
				echo json_encode($status);
			}
		}
		
	}

public function validasisp2d()
	{
		$id 	= $this->input->post('no_uji');
		$result = $this->advices_model->validasi_sp2d($id);
			if ($result) {
				$status=["status"=>1];
				echo json_encode($status);
			} else {
				$status=["status"=>0];
				echo json_encode($status);
			}
		
		// redirect(base_url('admin/languages'));
	}

	public function batalsp2d()
	{
		$id = $this->input->post('no_uji');
		$result = $this->advices_model->batal_sp2d($id);
		if ($result) {
			$status=["status"=>1];
			echo json_encode($status);
		} else {
			$status=["status"=>0];
			echo json_encode($status);
		}
		// redirect(base_url('admin/languages'));
	}

function get_detail_sp2d(){
			ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
    		ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');
		$id = $this->input->post('id',TRUE);
		$data = $this->advices_model->get_detail_sp2d($id)->result();
		echo json_encode($data);
	}

function get_token(){
		$a = $this->get_token_api();
		return $a;
	}
	
	function get_token_api(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/hh/auth",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n    \"key\" : \"04A26249DD8D33B6E1F244030C7870D7\"\n}",
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		  ),
		));
		// AENao6JDrf9+xCSwJks18IghphTdQuvcOBcVc7abvCo0WeZSDxm/9IPy+2EaqnVG
		$response = curl_exec($curl);
		// var_dump(curl_error($curl));
		curl_close($curl);
		$array = json_decode($response);
		
		$j=$array->data[0]->token;
		return $j;
	}
	function get_iv(){
		$a = $this->get_iv_api();
		$x=$a->data[0]->token;
		$y=$a->data[0]->passPhrase;
		$z=$a->data[0]->idKey;
		echo $x;
	}
	function get_iv_api(){
		$api_key = $this->get_token_api();
		$headers = array(
            'Authorization: Bearer '.$api_key
        );
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/api/sppd/hh/encrypt/key",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);
		curl_close($curl);
		
		$res = json_decode($response);
		$newData = (array) $res;
		$new0 = (array) $newData['data'][0];
		$new0['token'] = $api_key;
		$newData['data'][0] = (object) $new0;
		return (object)$newData;

	}

	function proses_kebank(){
        // try {
		ini_set('max_execution_time', -1);
		ini_set('memory_limit', -1);
      	$nouji    = $this->input->post('no_uji'); 
		
		$sqltot = "SELECT count(*) as tot from TRDUJI where no_uji=? and status='1'" ;
        $query1 = $this->db->query($sqltot, array($nouji));
        $total = $query1->row();
		$tot= $total->tot;

		if($tot==0){
			$data = array(
				'status' 		=> false,
				'message' 		=> 'SP2D belum diverifikasi atau sudah diproses !!'
			);
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		
		$sql = "SELECT no_sp2d from TRDUJI where no_uji=? and status='1'";
		$dt_sp2d = $this->db->query($sql, array($nouji))->result_array();
		$sukses=$tot;//0;
		$gagal=0;
		$data = array(
				'no' => $nouji,
				'sppd' => array(),
		);
         foreach($dt_sp2d as $kk => $vv){
			$no=$vv['no_sp2d'];
			$data['sppd'][] = $this->get_sp2d($no,$nouji);
		}

		// CEK JSON

		// $this->output
		// 	->set_content_type('application/json')
		// 	->set_output(json_encode($data));
		// return;


		$msg=json_encode($data);
		$token=$this->get_token_api();

		$datakirim = $msg;

		if($token==''){
			$data = array(
				'status' 		=> false,
				'message' 		=> 'Get Authorization Failed !!'
			);
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}

		
		$last_update =  date('Y-m-d H:i:s');
		$query ="INSERT into log_sp2donline(datakirim,token,nomor,lastupdate) 
                    values(?, ?, ?, ?) ";
        $asg = $this->db->query($query, array($datakirim,$token,$nouji,$last_update)); 
		if($asg){
			$this->kirim_sppd($datakirim,$token,$nouji);
		}

		

		
		// } catch (\Exception $e) {
		// 	var_dump(['message' => $e->getMessage(), 'stacktrace' => $e->getTraceAsString()]);
		// }
	}
	function get_sp2d($no='',$nouji='')
	{
		$result = array();
        $row = array();
		
          $sql = "SELECT  a.no_spp,a.no_sp2d,a.no_spm,a.tgl_sp2d as tgl,a.tgl_spm,a.kd_skpd,bank,left(a.keperluan,250)as keperluan,
		  	a.no_rek,replace(replace(npwp,'-',''),'.','')as npwp,
				(select sum(nilai) from trdspp where trdspp.no_spp=a.no_spp and a.kd_skpd=trdspp.kd_skpd)as nilai,ISNULL(b.potongan, 0) as potongan,
				(a.nilai-ISNULL(b.potongan, 0)) as netto ,left(a.keperluan,254)as keperluan,'PT. Bank Kalbar Cabang Utama Pontianak' as nm_bank_sumber,
				(SELECT TOP 1 nm_rekening from ms_rekening_bank_online where a.no_rek=rekening and a.kd_skpd=kd_skpd) as nmrekan,
				(SELECT status from TRDUJI where a.no_sp2d=no_sp2d) as statussp2d,
				(SELECT noReff from TRDUJI where a.no_sp2d=no_sp2d) as noref,
				'1001002830' as no_rek_sumber FROM trhsp2d a 
				left join(SELECT no_spm,kd_skpd,sum(nilai) as potongan from trspmpot GROUP BY no_spm,kd_skpd) b 
				on a.no_spm=b.no_spm and a.kd_skpd=b.kd_skpd
				where a.no_sp2d=? "; 
			$dt_sp2d = $this->db->query($sql, array($no))->result_array(); 
        	foreach($dt_sp2d as $kk => $vv){

        	$hasil=$this->db->query("SELECT noRef+1 as noReff FROM  noref_MPN WITH (TABLOCKX) ");

	        $noReff=$hasil->row()->noReff;
	            

			$sql_opd 				= "SELECT kd_skpd,nm_skpd from ms_skpd where kd_skpd=?";
			$sql_bank 				= "SELECT kd_bank as kdbank,nama_bank as nmbank from ms_bank_online a inner join ms_bank b on a.bic=b.bic where b.kode=?";
			$sql_pajak_pph 			= "SELECT isnull(sum(nilai),0)as totpph from trspmpot where no_spm=? AND kd_rek6 NOT IN('210105010001','210105020001','210105030001','210105030001','210109010001','210106010001')";
			$sql_pajak_ppn 			= "SELECT isnull(sum(nilai),0) as totppn from trspmpot where no_spm=? AND kd_rek6 IN('210105010001','210105020001','210105030001','210105030001','210109010001','210106010001')";
        
            $data['no'] 		= $vv['no_sp2d'];
			$data['nospm'] 		= $vv['no_spm'];
			$data['tgl'] 		= $vv['tgl'];

			// if ($vv['noref']===null){
	          	$this->db->set('noReff', $noReff);
				$this->db->where('no_uji', $nouji);
				$this->db->where('no_sp2d', $vv['no_sp2d']);
				$this->db->update('trduji');

				$this->db->set('noRef', $noReff);
				$this->db->update('noref_MPN');

				$data['noReffsppd'] = $noReff;
	        //   }else{
	        //   	$data['noReffsppd'] = $vv['noref'];
	        //   }
	        	$data['notes'] 		=$vv['keperluan'];
				$dt_opd 		= $this->db->query($sql_opd, array($vv['kd_skpd']))->result_array();
				foreach($dt_opd as $kkk => $vvv){                                                               
        						$data['opd']['code'] = $vvv['kd_skpd'];
                                $data['opd']['name'] = $vvv['nm_skpd'];
                }
			// DATA RKUD
			$result_rkud	= $this->db->query("SELECT TOP 1 * from ci_setting");
			$rkud			= $result_rkud->row()->rek_rkud;
			$nm_rkud		= $result_rkud->row()->nm_rek_rkud;
			$bank_rkud		= $result_rkud->row()->nm_bank_rkud;
			$tahun_anggaran	= $result_rkud->row()->tahun_anggaran;
             
			$data['dari'] 		= $nm_rkud;
			$data['ta'] 		= $tahun_anggaran;
			$data['bank'] 		= $bank_rkud;
			$data['akunAsal'] 	= $rkud;
			
            $data['jumlahBayar']=$vv['nilai'];
            $data['terbilang'] 	=$this->advices_model->terbilang($vv['nilai']);
            $dt_totpph 		= $this->db->query($sql_pajak_pph, array($vv['no_spm']))->result_array();
				foreach($dt_totpph as $kkkpph => $pphtot){                                                               
        						$data['jumlahPotonganNonMpn'] 	=$pphtot['totpph'];
                }
            $dt_totppn 		= $this->db->query($sql_pajak_ppn, array($vv['no_spm']))->result_array();
				foreach($dt_totppn as $kkkppn=> $ppntot){                                                               
        						$data['jumlahPotonganMpn'] 	=$ppntot['totppn'];
                }

				$dt_bank = $this->db->query($sql_bank, array($vv['bank']))->result_array();
				foreach($dt_bank as $kkkk => $vvvv){
                                $data['penerima']['kodeBank'] = $vvvv['kdbank'];
								$data['penerima']['namaBank'] = $vvvv['nmbank'];
								$data['penerima']['namaPenerima'] = $vv['nmrekan'];;
								$data['penerima']['noAkun'] = $vv['no_rek'];//
                                $data['penerima']['npwp'] = $vv['npwp'];;//
				}
			$data['keperluan'] 			= $vv['keperluan'];
			$data['jumlahDiminta'] 		= $vv['nilai'];
            $data['jumlahPotongan'] 	= $vv['potongan'];	
            $data['jumlahDibayar'] 		= $vv['netto'];
            $data['jumlahTerbilang'] 	= $this->advices_model->terbilang($vv['netto']);
            	
            $sql_jml_potongan ="SELECT COUNT(*) as jumlah from (SELECT kd_rek6,nm_rek6,nilai from trspmpot where no_spm=?) a";
            $hasil1 = $this->db->query($sql_jml_potongan, $vv['no_spm'])->row();
            $jumlahbarispot = $hasil1->jumlah; 
            if($jumlahbarispot>=1){

				// MPN
				$sql_potonganmpn = "SELECT no_spm,(select TOp 1 left(nm_skpd,50) from ms_skpd where kd_skpd=trspmpot.kd_skpd)  as keterangan,sum(nilai) as nilai,idBilling as idBilling from trspmpot  where no_spm= ? AND kd_rek6 IN('210105010001','210105020001','210105030001','210105030001','210109010001','210106010001') GROUP BY no_spm,kd_skpd,idBilling";		
                $dt_potonganmpn = $this->db->query($sql_potonganmpn, $vv['no_spm'])->result_array();	
                foreach($dt_potonganmpn as $kkkkkk => $vvvvvv){
                    $hasil2=$this->db->query("SELECT noRef+1 as noReff FROM  noref_MPN WITH (TABLOCKX) ");
					foreach ($hasil2->result_array() as $row2){
					$noReff2=$row2['noReff']; 
					}
                    
					$this->db->set('noreff', $noReff2);
					$this->db->where('no_spm', $vvvvvv['no_spm']);
					$this->db->where('idBilling', $vvvvvv['idBilling']);
					$this->db->update('trspmpot');

					$this->db->set('noRef', $noReff2);
					$this->db->update('noref_MPN');
					
					$data['detailPotonganMpn'][$kkkkkk]['keteranganPotongan'] = $vvvvvv['keterangan'];
                    $data['detailPotonganMpn'][$kkkkkk]['nominalPotongan'] = $vvvvvv['nilai'];
					$data['detailPotonganMpn'][$kkkkkk]['referenceNo'] = $noReff2;
                    $data['detailPotonganMpn'][$kkkkkk]['idBilling'] = $vvvvvv['idBilling'];
					
                }


				// NON MPN
				$sql_potongannonmpn = "SELECT no_spm,map_pot as kd_rek6, left(nm_rek6,50)  as keterangan,sum(nilai) as nilai from trspmpot  where no_spm= ? AND kd_rek6 NOT IN('210105010001','210105020001','210105030001','210105030001','210109010001','210106010001') GROUP BY no_spm,map_pot,nm_rek6
                 ";		
                $dt_potongannon = $this->db->query($sql_potongannonmpn, $vv['no_spm'])->result_array();	
                foreach($dt_potongannon as $llllll => $vvvvvvv){
					$data['detailPotonganNonMpn'][$llllll]['kodeMap'] =  $vvvvvvv['kd_rek6']; 
					$data['detailPotonganNonMpn'][$llllll]['keteranganKodeMap'] = $vvvvvvv['keterangan'];
					$data['detailPotonganNonMpn'][$llllll]['nominalPotongan'] = $vvvvvvv['nilai'];
                    	 
                    
                }
                 
                
            }
           

		}
		return $data;
	}
	

	

	function cek_advice()
	{
		// $request = $this->input->post();
		$request = json_decode(file_get_contents("php://input"), true);
		// return;
		$nouji = $request['data']['noadvice'];
		
		$sqltot = "SELECT count(*) as tot from TRDUJI where no_uji=?" ;
        $query1 = $this->db->query($sqltot, array($nouji));
        $total = $query1->row();
		$tot= $total->tot;
		
		$sql = "SELECT no_sp2d from TRDUJI where no_uji=?";
		$dt_sp2d = $this->db->query($sql, array($nouji))->result_array();
		$sukses=$tot;//0;
		$gagal=0;
		$data = array(
			'data' => array(
				'noadvice' => $nouji,
				'listsp2d' => array(),
			),
		);
        foreach($dt_sp2d as $kk => $vv){
			$no=$vv['no_sp2d'];
			$data['data']['listsp2d'][] = $this->get_sp2d($no);
		}
		if (strcmp(json_encode($request), json_encode($data)) !== 0) {
			// Tidak Sama
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 0, 'message' => 'Data tidak sesuai')));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 1, 'message' => 'Data sesuai')));
		}
	}

	function callback()
	{
		// $request = $this->input->post();
		$request = json_decode(file_get_contents("php://input"), true);
		// return;
		$nouji = $request['data']['noadvice'];
		
		$sqltot = "SELECT count(*) as tot from TRDUJI where no_uji=?" ;
        $query1 = $this->db->query($sqltot, array($nouji));
        $total = $query1->row();
		$tot= $total->tot;

		$sql = "SELECT no_sp2d from TRDUJI where no_uji=?";
		$dt_sp2d = $this->db->query($sql, array($nouji))->result_array();
		$sukses=$tot;//0;
		$gagal=0;
		$data = array(
			'data' => array(
				'noadvice' => $nouji,
				'listsp2d' => array(),
			),
		);
        foreach($dt_sp2d as $kk => $vv){
			$no=$vv['no_sp2d'];
			$data['data']['listsp2d'][] = $this->get_sp2d($no);
		}
		if (strcmp(json_encode($request), json_encode($data)) !== 0) {
			// Tidak Sama
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 0, 'message' => 'Data tidak sesuai')));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 1, 'message' => 'Data sesuai')));
		}
	}

	function config_get(){
		echo 'test';
		return;
		
	}

	
	
	function encrypt_mcrypt($msg, $iv = null) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		if (!$iv) {
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		}
		$pad = $iv_size - (strlen($msg) % $iv_size);
		$msg .= str_repeat(chr($pad), $pad);
		$encryptedMessage = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $msg, MCRYPT_MODE_CBC, $iv);
		return base64_encode($encryptedMessage);
	}
	
	function kirim_sppd($data,$token,$nouji){
		ini_set('max_execution_time', -1);
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/sppd/save",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer ".$token,
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		// echo $response;
		// return;
		$httpcode 	= curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		// $output = json_decode($response);
		// var_dump($response);
		if($httpcode == 200){
			echo $response; 
		}else{

			$msg = array(
				"status"=> false,
				"message"=> $httpcode,
				"maxPage"=> null,
				"perPage"=> null,
				"columns"=> null,
				"data"=> null	
				);
			echo json_encode($msg);
			
		}
		
		// exit();
		// $array = json_encode($response);
		// echo $array ; 
		// exit();
		// $b = explode('":',$array);
		// $c = explode(',\"',$b[1]);
		// return $c;

	

	}
	
	function verify_sppd()
	{
		$this->input->post('no_advice');
		$this->input->post('list_sp2d');
	}	

	function create_penerima(){
		$data['kodeBank'] = $this->input->post('kodebank');
		$data['namaPenerima'] = $this->input->post('nama');
		$data['noAkun'] = $this->input->post('rek');
		$datakirim = json_encode($data);
		// echo $datakirim;
		$api_key = $this->get_token_api();
		$headers = array(
            'Authorization: Bearer '.$api_key,
			"Content-Type: application/json"
        );
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/penerima/validasi",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>$datakirim,
		  CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);

		curl_close($curl);

		echo $response;
		
		// $array = json_encode($response);
		// $b = explode('":',$array);
		// $c = explode(',\"',$b[1]);
		// return $c;
	}
function kirimotp(){
		ini_set('max_execution_time', -1);
		ini_set('memory_limit', -1);
		$data['no'] 	= $this->security->xss_clean($this->input->post('advice'));
		$data['otp'] 	= $this->security->xss_clean($this->input->post('otp'));
		if (is_numeric($this->input->post('otp'))==false || is_numeric($this->input->post('otp'))!=1 ){
			$msg = array(	'status'=>'gagal',
							'sukses'=>$sukses,
							'pending'=>$pending,
							'gagal'=>$gagal,
							'suksesp'=>$suksesp,
							'pendingp'=>$pendingp,
							'gagalp'=>$gagalp
						);
                        echo json_encode($msg);
                        return;
		}

		$datakirim = json_encode($data);
		// echo $datakirim;
		$api_key = $this->get_token_api();
		$headers = array(
            'Authorization: Bearer '.$api_key,
			"Content-Type: application/json"
        );
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/sppd/execute",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>$datakirim,
		  CURLOPT_HTTPHEADER => $headers,
		));
		
		 header('Content-Type: application/json');
		 
		//  $response =  $this->advices_model->sampelresponse();
		
		
		$response = curl_exec($curl);
		$httpcode 	= curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		// $httpcode = 200;

		
		
		$date 		=  date('Y-m-d');
		$output 	= json_decode($response);
		// $output 	= $response;
		$gagal		= 0;
		$sukses		= 0;
		$gagalp		= 0;
		$pendingp 	= 0;
		$pending 	= 0;
		$suksesp 	= 0;
		// var_dump($output);
		// return;
		// $last_update =  date('Y-m-d H:i:s');
		// $query ="INSERT into log_sp2donline(datakirim,token,nomor,lastupdate) 
        //             values(?, ?, ?, ?) ";
		// $asg = $this->db->query($query, array($response,'OTP',$this->input->post('advice'),$last_update)); 
		// var_dump($response);
		if($httpcode != 200){
			$msg = array(
				'status'	=>false,
				'sukses'	=>0,
				'pending'	=>0,
				'gagal'		=>0,
				'suksesp'	=>0,
				'pendingp'	=>0,
				'gagalp'	=>0,
				'httpcode'	=>$httpcode,
				'result'	=>97,
				'data'		=>null
			);
		}else{
			if ($output->status === true || $output->status===1){  //true
				foreach ($output->data[0]->sppd as $hasil){
					$no_sp2d = $hasil->no;
					$result  = $hasil->responseCode;
					$message = $hasil->message;
					
					if($result=== 00 || $result==='00'){

						$nouji 		= $this->advices_model->get_nouji($no_sp2d);
						$nokasbud 	= $this->sp2d_model->get_no_kas_bud();
						
						$statusbud	= $hasil->mpn->kodeJenisTransaksi == 'Transfer-OnUs' ? 1 : 2; //2 : pending, 1 : Cair BUD
						$status 	= $hasil->mpn->kodeJenisTransaksi == 'Transfer-OnUs' ? 2 : 4; //3 : gagal    4 : pending
						$status_bank= $hasil->mpn->kodeJenisTransaksi == 'Transfer-OnUs' ? 4 : 2; //4 : sukses 	 2 : pending
						$tanggalTransaksi = $hasil->mpn->tanggalTransaksi;
						
						// action1
						$resultsp2d = $this->advices_model->updatesp2d($nokasbud,$nouji,$statusbud,$date,$no_sp2d);
						// action2
						$resultduji = $this->advices_model->detailuji($status,$message,$no_sp2d,$tanggalTransaksi);
						// action3
						$resulthuji = $this->advices_model->headeruji($status_bank,$nouji);
						// count sukses
						$sukses=++$sukses;
						// potongan
						if (count($hasil->mpn->detailPotonganMpn) > 0){
							foreach ($hasil->mpn->detailPotonganMpn as $hasil2){
								$idbilling 				= $hasil2->idBilling;
								$statusPaymentMpn  		= $hasil2->statusPaymentMpn;
								$ntpn  					= $hasil2->ntpn;
								// echo "response".$no_sp2d;
								if($statusPaymentMpn==='SUKSES' || $statusPaymentMpn==='Sukses'){
									$status_setor 	= 1;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$suksesp=++$suksesp;
								}else if($statusPaymentMpn==='Transaksi Pending'){
									$status_setor 	= 2;
									$ntpn			= null;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$pendingp=++$pendingp;
								}else{
									$status_setor 	= 0;
									$ntpn			= null;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$gagalp=++$gagalp;
								}
							}
						}

					}else if($result===11 || $result==='11'){ //pending
						$nouji 		= $this->advices_model->get_nouji($no_sp2d);
						$nokasbud 	= $this->sp2d_model->get_no_kas_bud();
						
						$statusbud	= 1;
						$status 	= 4;
						$status_bank= 2;
						$tanggalTransaksi = '';
						
						// action1
						$resultsp2d = $this->advices_model->updatesp2d($nokasbud,$nouji,$statusbud,$date,$no_sp2d);
						// action2
						$resultduji = $this->advices_model->detailuji($status,$message,$no_sp2d,$tanggalTransaksi);
						// action3
						$resulthuji = $this->advices_model->headeruji($status_bank,$nouji);
						// count pending
						$pending=++$pending;
						// potongan
						if (count($hasil->mpn->detailPotonganMpn) > 0){
							foreach ($hasil->mpn->detailPotonganMpn as $hasil2){
								$idbilling 				= $hasil2->idBilling;
								$statusPaymentMpn  		= $hasil2->statusPaymentMpn;
								$ntpn  					= $hasil2->ntpn;
								// echo "response".$no_sp2d;
								if($statusPaymentMpn==='SUKSES' || $statusPaymentMpn==='Sukses'){
									$status_setor 	= 1;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$suksesp=++$suksesp;
								}else if($statusPaymentMpn==='Transaksi Pending'){
									$status_setor 	= 2;
									$ntpn			= null;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$pendingp=++$pendingp;
								}else{
									$status_setor 	= 0;
									$ntpn			= null;
									$this->advices_model->updatepotongan($status_setor,$date,$ntpn,$statusPaymentMpn,$idbilling);
									$gagalp=++$gagalp;
								}
							}
						}

					}elseif ($result==='97' || $result===97){
						$gagal=++$gagal;
					}else{
						$nouji 		= $this->advices_model->get_nouji($no_sp2d);
						$status 	= 3;
						$status_bank= 5;
						// action2
						$resultduji = $this->advices_model->detailuji($status,$message,$no_sp2d,'');
						// action3
						$resulthuji = $this->advices_model->headeruji($status_bank,$nouji);
						// count gagal
						$gagal=++$gagal;
					}
	
					
					header('Content-Type: application/json');
					$msg = array(
						'status' 	=> $output->status,
						'sukses'	=> $sukses,
						'pending'	=> $pending,
						'gagal'		=> $gagal,
						'suksesp'	=> $suksesp,
						'pendingp'	=> $pendingp,
						'gagalp'	=> $gagalp,
						'httpcode'	=> $message,
						'result'	=> $result,
						'data'		=> $output
					);
				}
			}
		}
		
        echo json_encode($msg);

	}

	function kirimotp2(){
		$data['no'] 	= $this->input->post('advice');
		$data['otp'] 	= $this->input->post('otp');
		$datakirim = json_encode($data);
		// echo $datakirim;
		$api_key = $this->get_token_api();
		$headers = array(
            'Authorization: Bearer '.$api_key,
			"Content-Type: application/json"
        );
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/sppd/execute",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>$datakirim,
		  CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$date=  date('Y-m-d');
		$output = json_decode($response);
		$gagal=0;
		$sukses=0;
		$gagalp=0;
		$pendingp=0;
		$suksesp=0;
		if ($output->status===true){
			foreach ($output->data[0]->sppd as $hasil){
			$no_sp2d = $hasil->no;
			$result  = $hasil->result;
			$message = $hasil->message;
			// echo "response".$no_sp2d;
			if($result===true || $result==='true'){
				$this->db->set('status_bud', 1);
				$this->db->set('tgl_kas_bud', $date);
				$this->db->where('no_sp2d', $no_sp2d);
				$this->db->update('trhsp2d_test');

                $this->db->set('status', 2);
                $this->db->set('ket_payment', $message);
				$this->db->where('no_sp2d', $no_sp2d);
				$this->db->update('trduji');

                     // 2022 query jurnal
				$sukses=$sukses+1;
			}else{
				$gagal=$gagal+1;
				$this->db->set('status', 3);
				$this->db->set('ket_payment', $message);
				$this->db->where('no_sp2d', $no_sp2d);
				$this->db->update('trduji');
			}
		}

		foreach ($output->data[0]->ntp as $hasil2){
			$idbilling 		= substr($hasil2->no,0,15);
			$result2  		= $hasil2->result;
			$message2  		= $hasil2->message;
			$responseCode2  = $hasil2->responseCode;
			// echo "response".$no_sp2d;
			if($responseCode2===00 || $responseCode2==='00'){
				
				$this->db->set('status_setor', 1);
				$this->db->set('tgl_setor', $date);
				$this->db->set('keterangan', $message2);
				$this->db->where('idBilling', $idbilling);
				$this->db->update('trspmpot');

				$suksesp=$suksesp+1;
			}else if($responseCode2===11 || $responseCode2==='11'){
				if($message2===''){
					$message21='Pending';
				}else{
					$message21=$message2;
				}
				$this->db->set('status_setor', 2);
				$this->db->set('tgl_setor', $date);
				$this->db->set('keterangan', $message21);
				$this->db->where('idBilling', $idbilling);
				$this->db->update('trspmpot');

				$pendingp=$pendingp+1;
			}else{
				$gagalp=$gagalp+1;

				$this->db->set('status_setor', 0);
				$this->db->set('tgl_setor', $date);
				$this->db->set('keterangan', $message2);
				$this->db->where('idBilling', $idbilling);
				$this->db->update('trspmpot');
			}
		}
	}
		


		$msg = array('status'=>$output->status,'sukses'=>$sukses,'gagal'=>$gagal,'suksesp'=>$suksesp,'pendingp'=>$pendingp,'gagalp'=>$gagalp);
                        echo json_encode($msg);

	}
		

public function status_payment_pajak() {
		 $request 	= json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',file_get_contents("php://input")), true);
    	// variable
    	$nomorSP2D 				= $request['nomorSP2D'];
		$tanggaltransaksi		= $request['tanggalTransaksi'];
		$messageDetail			= $request['messageDetail'];
    	$responseCode 			= $request['responseCode'];
    	$detailPotonganMpn 		= $request['detailPotonganMpn'];
		$headers 	= getallheaders();
    	if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer ac7f1ee943063f61517658bfc4e4672fbcd32b5a') {

	    	$this->db->from('trduji');
				$this->db->where('no_sp2d',$request['nomorSP2D']);
				$hasilspm = $this->db->count_all_results();

    		if ($hasilspm=='' || $hasilspm==null || $hasilspm=='0' || $hasilspm==0){
					$data = array(
								'response_code' => '02',
								'status' 		=> true,
								'message' 		=> 'SP2D tidak tersedia',
								'data' 			=>$hasilspm
							);
							header('Content-Type: application/json');
	    					echo json_encode($data);
			}else{

					if ($request['responseCode'] == '00') {
						$hasil=$this->db->query("SELECT no_uji FROM  trduji where no_sp2d = ?", $nomorSP2D);
						$no_uji=$hasil->row()->no_uji;

						// $this->db->set('status_bud', 1);
						// $this->db->set('no_kas_bud', $this->sp2d_model->get_no_kas_bud());
						// $this->db->set('tgl_kas_bud', $tanggaltransaksi);
						// $this->db->set('no_advice', $no_uji);
						// $this->db->set('app_cair', 'SP2DONLINE');
						// $this->db->where('no_sp2d', $nomorSP2D);
						// $this->db->update('trhsp2d');
						
						$this->db->set('status', 2);
						$this->db->set('ket_payment', $messageDetail);
						$this->db->set('tgl_transfer', $tanggaltransaksi);
						$this->db->where('no_sp2d', $nomorSP2D);
						$this->db->update('trduji');

						

						$this->db->set('status_bank', 4);
						$this->db->where('no_uji', $no_uji);
						$query = $this->db->update('trhuji');
					}

						foreach ($detailPotonganMpn  as $potonganMpn){
							$idBilling = $potonganMpn['idBilling'];
							$responseCode = $potonganMpn['responseCode'];
							switch ($responseCode) {
								case '00':
									$this->db->set('status_setor', 1);
									$this->db->set('ntpn', $potonganMpn['ntpn']);
									$this->db->set('keterangan', $potonganMpn['messageDetail']);
									$this->db->where('idBilling', $idBilling);
									$this->db->update('trspmpot');
									break;

								case '11':
									$this->db->set('status_setor', 2);
									$this->db->where('idBilling', $idBilling);
									$this->db->update('trspmpot');
									break;
								
								default:
									break;
							}
						}
						$data = array(
							// 'idBilling' 	=>$idBilling,
							'response_code' => '00',
							'status' 		=> true,
							'message' 		=> 'SUKSES',
							'data' 			=> $request
						);
				header('Content-Type: application/json');
	    		echo json_encode($data);
	    	}
    	} else {
    		header('Content-Type: application/json');
    		echo json_encode(array(
    			'message' => 'Invalid authorization token.',
    			'status' => false
    		));
    		return;
    	}
    		
    	
    }

	function noreff_update(){
        $request 	        = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',file_get_contents("php://input")), true);
    	$reference_no 		= $request['reference_no'];
        $headers 	        = getallheaders();
        if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer ac7f1ee943063f61517658bfc4e4672fbcd32b5a') {
            $data = array(
                'noRef' => $reference_no
            );
            $data = $this->security->xss_clean($data);
            $result = $this->admin_model->update_noreff($data);
                if($result){
                    $response = array(
                        'response_code' => '00',
                        'status' 		=> true,
                        'message' 		=> 'SUKSES'
                    );
                }else{
                    $response = array(
                        'status' 		=> false,
                        'message' 		=> 'GAGAL'
                    );
                }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            header('Content-Type: application/json');
                echo json_encode(array(
                    'message' => 'Invalid authorization token.',
                    'status' => false
                ));
                return;
        }
    }


    function update_status_pembayaran_erik() {

    	  	$request = json_decode(file_get_contents("php://input"), true);
    		$headers = getallheaders();
    	if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer 309F8E7150EE5FDE159A1CF04C40B40F') {
				
				
				$this->db->from('trduji');
				$this->db->where('no_sp2d',$request['nomorSP2D']);
				$hasilspm = $this->db->count_all_results();

				if ($hasilspm=='' || $hasilspm==null || $hasilspm=='0' || $hasilspm==0){
					$data = array(
								'response_code' => '02',
								'message' 		=> 'SP2D tidak tersedia',
								'data' 			=> null
							);
				}else{

					if ($request['responseCode'] == '00') {
						$this->db->set('status_bud', 1);
						$this->db->where('no_sp2d', $request['nomorSP2D']);
						$this->db->update('trhsp2d');
						
						$this->db->set('status', 2);
						$this->db->where('no_sp2d', $request['nomorSP2D']);
						$this->db->update('trduji');
					}

						foreach ($request['detailPotonganMpn'] as $potonganMpn){
							$idBilling = $potonganMpn['idBilling'];
							$responseCode = $potonganMpn['responseCode'];
							switch ($responseCode) {
								case '00':
									$this->db->set('status_setor', 1);
									$this->db->set('ntpn', $potonganMpn['ntpn']);
									$this->db->where('idBilling', $idBilling);
									$this->db->update('trspmpot');
									break;

								case '11':
									$this->db->set('status_setor', 2);
									$this->db->where('idBilling', $idBilling);
									$this->db->update('trspmpot');
									break;
								
								default:
									break;
							}
						}
						$data = array(
							// 'idBilling' 	=>$idBilling,
							'response_code' => '00',
							'message' 		=> 'SUKSES',
							'data' 			=> $hasilspm
						);
				header('Content-Type: application/json');
	    		echo json_encode($data);
	    	}
    	} else {
    		header('Content-Type: application/json');
    		echo json_encode(array(
    			'message' => 'Invalid authorization token.',
    			'status' => false,
    		));
    		return;
    	}
    }

	function infosp2d() {
		ini_set('max_execution_time', -1);
		$data['nomorSP2D'] 	= $this->input->post('no_sp2d');
		$datakirim 			= json_encode($data);
		$api_key 			= $this->get_token_api();
		$curl 				= curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/sppd/check",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $datakirim,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$api_key,
				"Content-Type: application/json"
			  ),
			));
	
			$response = curl_exec($curl);
			$httpcode 	= curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if($httpcode == 200){
				echo $response; 
			}else{
				$msg = array(
					"status"=> false,
					"message"=> $httpcode,
					"maxPage"=> null,
					"perPage"=> null,
					"columns"=> null,
					"data"=> null	
					);
				echo json_encode($msg);
				
			}
		
	}

	function callbacksp2d() {
		ini_set('max_execution_time', -1);
		$data['nomorSP2D'] 	= $this->input->post('no_sp2d');
		$datakirim 			= json_encode($data);
		$api_key 			= $this->get_token_api();
		$curl 				= curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://192.168.9.2:10090/api/sppd/sppd/check",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $datakirim,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$api_key,
				"Content-Type: application/json"
			  ),
			));
	
			$response = curl_exec($curl);
			$httpcode 	= curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if($httpcode == 200){
				$datasp2d = json_decode($response);
				// callback
				if($datasp2d->data[0]->response_code === '00'){
					
					$nomorSP2D 				= $datasp2d->data[0]->data->nomorSP2D;
					$nomorSPM 				= $datasp2d->data[0]->data->nomorSPM;
					$tanggaltransaksi		= $datasp2d->data[0]->data->tanggalTransaksi;
					$messageDetail			= $datasp2d->data[0]->data->messageDetail;
					$responseCode 			= $datasp2d->data[0]->data->responseCode;
					$detailPotonganMpn 		= $datasp2d->data[0]->data->detailPotonganMpn;
					$detailPotonganNonMpn 	= $datasp2d->data[0]->data->detailPotonganNonMpn;

						$this->db->from('trduji');
						$this->db->where('no_sp2d',$nomorSP2D);
						$hasilspm = $this->db->count_all_results();

					if ($hasilspm=='' || $hasilspm==null || $hasilspm=='0' || $hasilspm==0){
							$data = array(
										'response_code' => '02',
										'status' 		=> true,
										'message' 		=> 'SP2D tidak tersedia',
										'data' 			=>$hasilspm
									);
									header('Content-Type: application/json');
									echo json_encode($data);
					}else{
						$hasil=$this->db->query("SELECT no_uji FROM  trduji where no_sp2d = ?", $nomorSP2D);
						$no_uji=$hasil->row()->no_uji;
						
						$this->db->set('status', 2);
						$this->db->set('ket_payment', $messageDetail);
						$this->db->set('tgl_transfer', $tanggaltransaksi);
						$this->db->where('no_sp2d', $nomorSP2D);
						$this->db->update('trduji');

						$this->db->set('status_bank', 4);
						$this->db->where('no_uji', $no_uji);
						$query = $this->db->update('trhuji');
						if(count($detailPotonganMpn) > 0){
							foreach ($detailPotonganMpn  as $potonganMpn){
								$idBilling = $potonganMpn->idBilling;
						
								$this->db->set('status_setor', 1);
								$this->db->set('ntpn', $potonganMpn->ntpn);
								$this->db->set('keterangan', $potonganMpn->messageDetail);
								$this->db->where('idBilling', $idBilling);
								$this->db->where('no_spm', $nomorSPM);
								$this->db->update('trspmpot');
							
							}
						}
						if(count($detailPotonganNonMpn) >0){
							foreach ($detailPotonganNonMpn  as $potonganNonMpn){
								$kodeMap = $potonganNonMpn->kodeMap;
	
								$this->db->set('status_setor', 1);
								$this->db->set('keterangan', $potonganNonMpn->messageDetail);
								$this->db->where('map_pot', $kodeMap);
								$this->db->where('no_spm', $nomorSPM);
								$this->db->update('trspmpot');
							
							}
						}
						$data = array(
							// 'idBilling' 	=>$idBilling,
							'response_code' => $datasp2d->data[0]->response_code,
							'status' 		=> true,
							'message' 		=> $datasp2d->data[0]->message
						);
						header('Content-Type: application/json');
						echo json_encode($data);
					}
				}else{
					$data = array(
						'response_code' => $datasp2d->data[0]->response_code,
						'status' 		=> true,
						'message' 		=> $datasp2d->data[0]->message
					);
					header('Content-Type: application/json');
					echo json_encode($data);
				}
				
			}else{
				$msg = array(
					"status"=> false,
					"message"=> $httpcode,
					"maxPage"=> null,
					"perPage"=> null,
					"columns"=> null,
					"data"=> null	
					);
				echo json_encode($msg);
				
			}
		
	}

 //    function status_payment_pajak() {
 //    	$request = json_decode(file_get_contents("php://input"), true);
 //    	$headers = getallheaders();
 //    	    	if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer 309F8E7150EE5FDE159A1CF04C40B40F') {

 //    	}else{
 //    		header('Content-Type: application/json');
 //    		echo json_encode(array(
 //    			'message' => 'Source tidak digunakan lagi.',
 //    			'status' => false,
 //    			'data' 	=> $kodeSetor 
 //    		));
 //    		return;
 //    	}
	// }
    
}
