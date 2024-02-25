<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sp2d extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/advices_model', 'advices_model');
        $this->load->model('admin/sp2d_model', 'sp2d_model');
		$this->load->model('supportskpd', 'supportskpd');
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

	public function indexOld()
	{	
        
		$data['title'] = 'Verifikasi SP2D';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/sp2d/index');
		$this->load->view('admin/includes/_footer');
	}

	public function index()
	{	
        
		$data['title'] = 'Verifikasi SP2D';
		$this->load->view('includes/_header', $data);
		$this->load->view('daftarSP2D/index');
		$this->load->view('includes/_footer');
	}

	public function datatable_json()
    {
        header('Content-Type: application/json');
        $list = $this->sp2d_model->get_datatables();
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $datasp2d) {
            $no++;
			if ($datasp2d->is_verified == null){
				$status='<div class="text-center"><span class="badge bg-warning" > Belum Verifikasi</span></div>';
			  }else if ($datasp2d->is_verified =='1'){
				$status='<div class="text-center"><span class="badge bg-success" > Diverifikasi</span> </div>';
			  }else if ($datasp2d->is_verified =='2'){
				$status='<div class="text-center"><span class="badge bg-danger" > Ditolak</span></div>';
			  }else if ($datasp2d->is_verified =='4'){
				$status='<div class="text-center"><span class="badge bg-primary" > Daftar penguji</span></div>';
			  }else{
				$status='<div class="text-center"><span class="badge bg-warning" ></span></div>';
			  }

            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->no_sp2d .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->tgl_sp2d .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->keperluan .'<br>SKPD :'.$datasp2d->nm_skpd.'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px"><b>Penerima:</b><br>'. $datasp2d->penerima.'<br> <b>Rekening: </b><br>'. $datasp2d->no_rek .'</font></span></div></td>';
            $row[] = '<div class="text-right"><span align="left"><font size="2px">'. number_format($datasp2d->nilai,2,",","."). '</font></span></div></td>';
			$row[] = $status;
			$row[] = '<a title="Detail SP2D" class="btn btn-sm btn-success detailsp2d text-white" data-sp2d="'.$this->security->xss_clean($datasp2d->no_sp2d).'"> <i class="fa fa-list"></i></a>'; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->sp2d_model->count_all(),
            "recordsFiltered" => $this->sp2d_model->count_all(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }


	public function tabelpotongan($no_sp2d){
		header('Content-Type: application/json');
        $list = $this->sp2d_model->get_datapotongan($no_sp2d);
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $datapotongan) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datapotongan->kd_rek6 .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datapotongan->nm_rek6 .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $this->sp2d_model->formatbilling($datapotongan->idbilling) .'</font></span></div></td>';
            $row[] = '<div class="text-right"><span align="left"><font size="2px">'. number_format($datapotongan->nilai,2,",","."). '</font></span></div></td>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->sp2d_model->count_all3(),
            "recordsFiltered" => $this->sp2d_model->count_all3(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
	}



	public function datatable_json_verified()
    {
        header('Content-Type: application/json');
        $list = $this->sp2d_model->get_datatables2();
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $datasp2d) {
            $no++;
			if ($datasp2d->is_verified == null){
				$status='<div class="text-center"><span class="badge bg-warning" > Belum Verifikasi</span></div>';
			  }else if ($datasp2d->is_verified =='1'){
				$status='<div class="text-center"><span class="badge bg-success" > Diverifikasi</span> / <span class="badge bg-success" >'.$datasp2d->user_verif.'</span></div>';
			  }else if ($datasp2d->is_verified =='2'){
				$status='<div class="text-center"><span class="badge bg-danger" > Ditolak</span></div>';
			  }else if ($datasp2d->is_verified =='3'){
				$status='<div class="text-center"><span class="badge bg-primary" > Daftar penguji</span></div>';
			  }else{
				$status='<div class="text-center"><span class="badge bg-warning" ></span></div>';
			  }

            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->no_sp2d .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->tgl_sp2d .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->keperluan .'<br>SKPD :'.$datasp2d->nm_skpd.'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px"><b>Penerima:</b><br>'. $datasp2d->nmrekan .'<br> <b>Rekening: </b><br>'. $datasp2d->no_rek .'</font></span></div></td>';
            $row[] = '<div class="text-right"><span align="left"><font size="2px">'. number_format($datasp2d->nilai,2,",","."). '</font></span></div></td>';
			$row[] = $status;
			if($datasp2d->is_verified !='3'){
				$row[] = '<a title="Detail SP2D" class="btn btn-sm btn-primary detailsp2d text-white" data-sp2d="'.$this->security->xss_clean($datasp2d->no_sp2d).'"> <i class="fa fa-list"></i></a>'; 
			}else{
				$row[] = ''; 
			}
			
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->sp2d_model->count_all2(),
            "recordsFiltered" => $this->sp2d_model->count_all2(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

	public function datatable_json_cair()
    {
        header('Content-Type: application/json');
        $list = $this->sp2d_model->get_datatables3();
        $data = array();
        $no = $this->input->get('start');
        //looping data mahasiswa
        foreach ($list as $datasp2d) {
            $no++;
			if ($datasp2d->status_bud != 1){
				$status='<div class="text-center"><span class="badge bg-warning" > Belum Cair</span></div>';
			  }
			//   else if ($datasp2d->is_verified =='1'){
			// 	$status='<div class="text-center"><span class="badge bg-success" > Diverifikasi</span></div>';
			//   }else if ($datasp2d->is_verified =='2'){
			// 	$status='<div class="text-center"><span class="badge bg-danger" > Ditolak</span></div>';
			//   }else if ($datasp2d->is_verified =='4'){
			// 	$status='<div class="text-center"><span class="badge bg-primary" > Daftar penguji</span></div>';
			//   }
			  else{
				$status='<div class="text-center"><span class="badge bg-success" > Cair Kasda</span></div>';
			  }

            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->no_sp2d .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->tgl_sp2d .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $datasp2d->keperluan .' <br>SKPD :'.$datasp2d->nm_skpd.'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px"><b>Penerima:</b><br>'. $datasp2d->nmrekan .'<br> <b>Rekening: </b><br>'. $datasp2d->no_rek .'</font></span></div></td>';
            $row[] = '<div class="text-right"><span align="left"><font size="2px">'. number_format($datasp2d->nilai,2,",","."). '</font></span></div></td>';
			$row[] = $status;
			$row[] = '<a title="Detail SP2D" class="btn btn-sm btn-primary detailsp2d text-white" data-sp2d="'.$this->security->xss_clean($datasp2d->no_sp2d).'"> <i class="fa fa-list"></i></a>'; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->sp2d_model->count_all3(),
            "recordsFiltered" => $this->sp2d_model->count_all3(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }


	function datatable_jsons()
    {
        $list = $this->sp2d_model->get_datatables();
        $data = array();
        $no =$this->input->post('start');
        foreach ($list as $field) {

			// kondisi
			if ($field->is_verified == null){
				$status='<span class="badge bg-warning">Belum verifikasi</span>';
			  }else if ($field->is_verified =='1'){
				$status='<span class="badge bg-info">Sudah Verifikasi</span>';
			  }else if ($field->is_verified =='2'){
				$status='<span class="badge bg-danger">Ditolak</span>';
			  }else{
				$status='<span class="badge bg-warning">Belum verifikasi</span>';
			  }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $field->no_sp2d .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $field->tgl_sp2d .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px">'. $field->keperluan .'</font></span></div></td>';
            $row[] = '<div class="text-left"><span align="left"><font size="2px"><b>Penerima:</b>'. $field->nmrekan .'<br> Rekening: <b></b>'. $field->no_rek .'</font></span></div></td>';
			$row[] = '<div class="text-left"><span align="left"><font size="2px">'. $status .'</font></span></div></td>';
			$row[] = '<div class="text-right"><span align="right"><font size="2px">'.number_format($field->nilai,2,",",".") .'</font></span></div>';
			$row[] = '<a title="Detail SP2D" class="btn btn-sm btn-primary detailsp2d text-white" 
			data-sp2d="'.$this->security->xss_clean($field->no_sp2d).'"> 
			<i class="fa fa-list"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" =>$this->input->post('draw'),
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

	function get_status_anggaran($skpd){
        // $skpd     = $this->session->userdata('kdskpd');
        $n_status = '';
        
        $sql = "SELECT TOP 1 * from trhrka where kd_skpd ='$skpd' and status='1' order by tgl_dpa DESC";

        $q_trhrka = $this->db->query($sql);
        $num_rows = $q_trhrka->num_rows();
        
        foreach ($q_trhrka->result() as $r_trhrka){
             $n_status = $r_trhrka->jns_ang;                   
        }    
        return $n_status;                         
    }

// cetakan sp2d
function sp2d($lcnosp2d){

	$lntahunang = '2023';
	$lcnosp2d = str_replace("okepunya","/",$lcnosp2d);

	
	$banyak = 22;
	$jns_cetak = 1;
	$a ='*'.$lcnosp2d.'*';
	$csql = "SELECT a.*,
			(SELECT nmrekan FROM trhspp WHERE no_spp = a.no_spp AND kd_skpd=a.kd_skpd) AS nmrekan,
			(SELECT pimpinan FROM trhspp WHERE no_spp = a.no_spp AND kd_skpd=a.kd_skpd) AS pimpinan,
			(SELECT alamat FROM trhspp WHERE no_spp = a.no_spp AND kd_skpd=a.kd_skpd) AS alamat
			 FROM trhsp2d a WHERE a.no_sp2d = '$lcnosp2d'";
	$hasil = $this->db->query($csql);
	$trh = $hasil->row();
	$lckd_skpd  = $trh->kd_skpd;
	$lcnospm    = $trh->no_spm;
	$ldtglspm   = $trh->tgl_spm;
	$lcnmskpd   = $trh->nm_skpd;
	$lckdskpd   = $trh->kd_skpd;
	$alamat     = $trh->alamat;
	$lcnpwp     = $trh->npwp;
	$rekbank    = $trh->no_rek;
	$lcperlu    = $trh->keperluan;
	$lcnospp    = $trh->no_spp;
	$tgl        = $trh->tgl_sp2d;
	//$n          = $trh->nilai;
	$pimpinan   = $trh->pimpinan;
	$nmrekan    =$trh->nmrekan;
	$jns_bbn    =$trh->jenis_beban;
	$jns        =$trh->jns_spp;
	$bank=$trh->bank;
	$banyak_kar = strlen($lcperlu);
	$tanggal    = $this->supportskpd->tanggal_format_indonesia($tgl);
	
	$csqlnilai = "SELECT sum(nilai) [nilai] from  trdspp WHERE no_spp = '$lcnospp'";
	$hasiln = $this->db->query($csqlnilai);
	$trhn = $hasiln->row();
	$n          = $trhn->nilai;
	
	$sqlrek="SELECT bank,rekening, npwp FROM ms_skpd WHERE kd_skpd = '$lckd_skpd' ";
			 $sqlrek=$this->db->query($sqlrek);
			 foreach ($sqlrek->result() as $rowrek)
			{
				$bank_ben=$rowrek->bank;                    
				$rekben=$rowrek->rekening;                    
				$npwp_ben= $rowrek->npwp;
			}
		$rek_ben 		= empty($rekben) || $rekben == 0 ? '' :$rekben;
		$npwp_ben 		= empty($npwp_ben) || $npwp_ben == 0 ? '' :$npwp_ben;
		$nama_bank 		= empty($bank) ? 'Belum Pilih Bank' :$this->supportskpd->get_nama($bank,'nama','ms_bank','kode');
		$nama_bank_ben 	= empty($bank_ben) ? 'Belum Pilih Bank' :$this->supportskpd->get_nama($bank_ben,'nama','ms_bank','kode');
		$sqlttd1="SELECT TOP 1 nama as nm,nip as nip,jabatan as jab,pangkat FROM ci_setting ";
			 $sqlttd=$this->db->query($sqlttd1);
			 foreach ($sqlttd->result() as $rowttd)
			{
				$nip=$rowttd->nip;                    
				$nama= $rowttd->nm;
				$jabatan  = $rowttd->jab;
				$pangkat=$rowttd->pangkat;
			}
	$sqlnam="SELECT TOP 1 * FROM ms_ttd WHERE kd_skpd = '$lckdskpd' AND kode in ('BK','BPP') ";
			 $sqlnam=$this->db->query($sqlnam);
			 foreach ($sqlnam->result() as $rownam)
			{
				$nama_ben=$rownam->nama;                    
				$jabat_ben=$rownam->jabatan;                    
			}
	$nama_ben = empty($nama_ben) ? 'Belum Ada data Bendahara' :$nama_ben;
	$jabat_ben = empty($jabat_ben) ? ' ' :$jabat_ben;
	
	if (($jns == '1') or ($jns == '2')  or ($jns == '4') or ($jns == '5')){
	$kd_kegi = '';                    
	$nm_kegi = ''; 
	$kd_prog = ''; 
	$nm_prog = '';  
	}
	else {
	$sql12="SELECT kd_sub_kegiatan FROM trdspp a INNER JOIN trhsp2d b ON a.no_spp = b.no_spp AND a.kd_skpd=b.kd_skpd 
			WHERE b.kd_skpd = '$lckdskpd' AND no_sp2d='$lcnosp2d' group by kd_sub_kegiatan ";
			 $sqlrek12=$this->db->query($sql12);
			 foreach ($sqlrek12->result() as $rowrek)
			{
				$kd_kegi=$rowrek->kd_sub_kegiatan;                    
			}
	$nm_kegi = "";//" - ".$this->supportskpd->get_nama($kd_kegi,'nm_sub_kegiatan','trskpd','kd_sub_kegiatan') ; 
	$kd_prog = $this->supportskpd->left($kd_kegi,7); 
	$nm_prog = "";//" - ".$this->supportskpd->get_nama($kd_prog,'nm_program','trskpd','kd_program'); 
	}
	if($jns_cetak=='2'){
		$tinggi='150px';
		//$banyak=9;
		$banyak=10;
	} else 
	if($jns_cetak=='1'){
		//$tinggi='80px';
		$tinggi='10px';
		//$banyak=15;
		$banyak=$this->uri->segment(6);
	}else{
		$tinggi='10px';
		$banyak=$banyak;
	}       
	
	$cRet = '';
			 
	$cRet .= "<br><br><br><br><br>
	<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px;\"  width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
	$cRet .="
	<tr>
		<td align=\"center\" width=\"50%\" style=\"border-collapse:collapse;font-weight:bold; font-size:12px\"> PROVINSI KALIMANTAN BARAT
		</td>
		<td align=\"center\" width=\"50%\">
			<table style=\"border-collapse:collapse;font-size:12px; font-weight: bold;\" width=\"100%\" align=\"center\" cellspacing=\"4\" cellpadding=\"0\">
				
				<tr>
					<td align=\"center\">
						SURAT PERINTAH PENCAIRAN DANA (SP2D)
					</td>
				</tr>
				<tr>
					<td align=\"center\">
						<b>Nomor : $lcnosp2d</b>
					</td>
				</tr>
			</table>
		</td>
	</tr>   
	<tr>
		<td style=\"border-left:solid 1px black;\" >
			<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" valign=\"top\" border=\"1\" cellspacing=\"4\" cellpadding=\"0\">
					<tr>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" width=\"25%\" align=\"left\" valign=\"top\">&nbsp;Nomor SPM</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" width=\"2%\" valign=\"top\">:</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" width=\"73%\" valign=\"top\">$lcnospm</td>
				</tr>
				<tr>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\">&nbsp;Tanggal</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\" >:</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\">".$this->supportskpd->tanggal_format_indonesia($ldtglspm)."</td>
				</tr>
				<tr>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\">&nbsp;Nama SKPD</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\">:</td>
					<td style=\"border-left:hidden;border-top: hidden;border-bottom: hidden; border-right: hidden;\" valign=\"top\" height=\"60px\">$lckd_skpd $lcnmskpd</td>
				</tr>
			</table>
		</td>
		<td>
			<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\"  valign=\"top\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
				<tr>
					<td valign=\"top\">&nbsp;Dari &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Kuasa BUD</td>
				</tr>
				 <tr>
					<td valign=\"top\" >&nbsp;NPWP </td>
				</tr>
				<tr>
					<td valign=\"top\" >&nbsp;Tahun Anggaran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lntahunang</td>
				</tr>
				<tr>
					<td valign=\"top\" >&nbsp;</td>
				</tr>
				<tr>
					<td valign=\"top\" >&nbsp;</td>
				</tr>
				<tr>
					<td valign=\"top\" >&nbsp;</td>
				</tr>
				<tr>
					<td valign=\"top\" >&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
		<tr>
	<td colspan=\"2\">
		<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12x\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"4\" cellpadding=\"0\">
		<tr>
			<td style=\"border-bottom: hidden; border-right: hidden;font-family: Open Sans;font-size:12px\" width=\"120px\">&nbsp;Bank Pengirim</td>
			<td style=\"border-bottom: hidden;font-family: Open Sans;font-size:12px;\" >:&nbsp;PT. Bank Kalbar Cabang Utama Pontianak</td>
		</tr>
		<tr>
			<td style=\"border-bottom: hidden;font-family: Open Sans;font-size:12px\" colspan=\"2\" >&nbsp;Hendaklah mencairkan / memindahbukukan dari baki Rekening Nomor 1001002201</td>
		</tr>
		<tr>
			<td style=\"border-bottom: hidden;font-family: Open Sans;font-size:12px; border-right: hidden;\" >&nbsp;Uang sebesar Rp</td>
			<td style=\"border-bottom: hidden;font-family: Open Sans;font-size:12px;\" >:&nbsp;Rp".number_format($n,'2',',','.')."  (".$this->supportskpd->terbilang($n).") </td>
		</tr>
		</table>
	</td>
	</tr>   
	<tr>
		<td colspan=\"2\">";


		$field = $this->get_status_anggaran($lckd_skpd);
		// // echo $field;
		// if($field=='Perubahan'){
		//     $kol='nilai_ubah';
		// }else if($field=='Penyempurnaan'){
		//     $kol='nilai_sempurna';
		// }else{
		//     $kol='nilai';
		// }


		if ($jns==2){
			$sql_pagu="SELECT sum(nilai)total FROM trdrka where jns_ang='$field' and kd_sub_kegiatan in (select a.kd_sub_kegiatan from trdspp a 
inner join trhspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd  
where a.no_spp='$lcnospp' AND left(a.kd_skpd,17)=left('$lckd_skpd',17)and b.jns_spp not in ('1','2')) AND left(kd_skpd,17)=left('$lckd_skpd',17)";
		}else{
			$sql_pagu="SELECT sum(nilai)total FROM trdrka where jns_ang='$field' and kd_sub_kegiatan in (select a.kd_sub_kegiatan from trdspp a 
inner join trhspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd  
where a.no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd' and b.jns_spp not in ('1','2')) AND kd_skpd='$lckd_skpd'";
		}

		
			 $sql_pagus=$this->db->query($sql_pagu);
			 foreach ($sql_pagus->result() as $row_pagu)
			{
				$pagu_ang=$row_pagu->total;                    
			}


	if(($jns==6) && ($jns_bbn==6)){

		 $cRet .="<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">
		   <tr>
				<td valign=\"top\" width=\"120px\">&nbsp;Kepada</td>
				<td valign=\"top\" width=\"10px\" >:</td>
				<td valign=\"top\" >$pimpinan, $nmrekan, $alamat</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;NPWP</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$lcnpwp</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;No.Rekening Bank</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$rekbank</td>
			</tr>
			<tr>
				<td valign=\"top\">&nbsp;Bank Penerima</td>
				<td valign=\"top\">:</td>
				<td valign=\"top\">$nama_bank</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Keperluan Untuk</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >$lcperlu
				<br>".$this->supportskpd->right($kd_prog,2)."$nm_prog
				<br>".$this->supportskpd->right($kd_kegi,2)."$nm_kegi
				</td>

			</tr>
			<tr>
				<td valign=\"top\" colspan=\"3\">&nbsp;</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Pagu Anggaran</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >Rp".number_format($pagu_ang,"2",",",".")."
				</td>
			</tr>
			</table> ";
	}
	else if($jns==5 ){

		  $cRet .="<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">
		   <tr>
				<td valign=\"top\" width=\"120px\">&nbsp;Kepada</td>
				<td valign=\"top\" width=\"10px\" >:</td>
				<td valign=\"top\" >$pimpinan, $nmrekan, $alamat</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;NPWP</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$lcnpwp</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;No.Rekening Bank</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$rekbank</td>
			</tr>
			<tr>
				<td valign=\"top\">&nbsp;Bank Penerima</td>
				<td valign=\"top\">:</td>
				<td valign=\"top\">$nama_bank</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Keperluan Untuk</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >$lcperlu
				<br>".$this->supportskpd->right($kd_prog,2)."$nm_prog
				<br>".$this->supportskpd->right($kd_kegi,2)."$nm_kegi
				</td>

			</tr>
			<tr>
				<td valign=\"top\" colspan=\"3\">&nbsp;</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Pagu Anggaran</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >Rp".number_format($pagu_ang,"2",",",".")."
				</td>
			</tr>
			</table> ";
	}else if ($jns=='1'){
		$cRet .="<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">
		   <tr>
				<td valign=\"top\" width=\"120px\">&nbsp;Kepada </td>
				<td valign=\"top\" width=\"10px\">:&nbsp;</td>
				<td valign=\"top\" font-family: Arial; >$nama_ben - $jabat_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;NPWP</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$npwp_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;No.Rekening Bank</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$rek_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Bank Penerima</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$nama_bank_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Keperluan Untuk</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >$lcperlu
				<br>".$this->supportskpd->right($kd_prog,2)."$nm_prog
				<br>".$this->supportskpd->right($kd_kegi,2)."$nm_kegi
				</td>
			</tr>
			<tr>
				<td valign=\"top\" colspan=\"3\">&nbsp;</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Pagu Anggaran</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >
				</td>
			</tr>
			</table> ";
		
	}else{
		$cRet .="<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">
		   <tr>
				<td valign=\"top\" width=\"120px\">&nbsp;Kepada </td>
				<td valign=\"top\" width=\"10px\">:&nbsp;</td>
				<td valign=\"top\" font-family: Arial; >$nama_ben - $jabat_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;NPWP</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$npwp_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;No.Rekening Bank</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$rek_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Bank Penerima</td>
				<td valign=\"top\" >:</td>
				<td valign=\"top\" >$nama_bank_ben</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Keperluan Untuk</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >$lcperlu
				<br>".$this->supportskpd->right($kd_prog,2)."$nm_prog
				<br>".$this->supportskpd->right($kd_kegi,2)."$nm_kegi
				</td>
			</tr>
			<tr>
				<td valign=\"top\" colspan=\"3\">&nbsp;</td>
			</tr>
			<tr>
				<td valign=\"top\" >&nbsp;Pagu Anggaran</td>
				<td valign=\"top\" >:</td>
				<td height=\"$tinggi\" valign=\"top\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" >Rp".number_format($pagu_ang,"2",",",".")."
				</td>
			</tr>
			</table> ";
		
	}
	 $cRet  .="  </td>
	</tr>
	<tr>
		<td colspan=\"2\">
			<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
				<tr >
					<td width=\"5%\" align=\"center\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\"><b>NO</b></td>
					<td width=\"28%\" align=\"center\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\"><b>KODE KEGIATAN/SUB KEGIATAN</b></td>
					<td align=\"center\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\"><b>URAIAN</b></td>
					<td width=\"15%\" align=\"center\" style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\"><b>JUMLAH<br>(Rp)</b></td>
				</tr>
				<tr>
					<td align=\"center\">1</td>
					<td align=\"center\">2</td>
					<td align=\"center\">3</td>
					<td align=\"center\">4</td>
				</tr>";
		$sql_total="SELECT sum(nilai)total FROM trdspp where no_spp='$lcnospp' AND kd_skpd='$lckd_skpd'";
			 $sql_x=$this->db->query($sql_total);
			 foreach ($sql_x->result() as $row_x)
			{
				$lntotal=$row_x->total;                    
			}
			if(($jns==1) || ($jns==2)){
									$sql = "SELECT SUM(nilai) nilai from trdspp where no_spp='$lcnospp' AND kd_skpd='$lckd_skpd'";
									$hasil = $this->db->query($sql);
									$lcno = 0;
									$lntotal = 0;
									foreach ($hasil->result() as $row)
									{
									   $lcno = $lcno + 1;
									   $lntotal = $lntotal + $row->nilai;
										$cRet .="<tr>
													<td style=\"border-bottom: hidden;\" align=\"center\">&nbsp;1</td>
													<td style=\"border-bottom: hidden;\">&nbsp; $lckd_skpd  </td>
													<td style=\"border-bottom: hidden;\">&nbsp; $lcnmskpd</td>
													<td style=\"border-bottom: hidden;\" align=\"right\">".number_format($row->nilai,"2",",",".")."&nbsp;</td>
												</tr>"; 
									  
									}  
										if($lcno<=$banyak)
										   {
											 for ($i = $lcno; $i <= $banyak; $i++) 
											  {
												 $cRet .="<tr>
													<td style=\"border-top: hidden;\" align=\"center\">&nbsp;</td>
													<td style=\"border-top: hidden;\" ></td>
													<td style=\"border-top: hidden;\"></td>
													<td style=\"border-top: hidden;\" align=\"right\"></td>
												</tr>";    
											  }                                                   
										   } 
									   }
			else{
			
			
			
			$sql1 = "SELECT COUNT(*) as jumlah from 
						(

							select '1'as urut,left(a.kd_sub_kegiatan,12)as kd_sub_kegiatan,left(a.kd_sub_kegiatan,12) kd_rek,b.nm_kegiatan as nm_rek,sum(nilai)nilai from trdspp a inner join 
							trskpd b on a.kd_sub_kegiatan=b.kd_sub_kegiatan where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by left(a.kd_sub_kegiatan,12),nm_kegiatan
							union all
							select '2'as urut,kd_sub_kegiatan,kd_sub_kegiatan kd_rek,a.nm_sub_kegiatan as nm_rek,sum(nilai)nilai from trdspp a where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by kd_sub_kegiatan,nm_sub_kegiatan
							union all
							select '3'as urut,kd_sub_kegiatan,a.kd_rek6 kd_rek,b.nm_rek6 as nm_rek,sum(nilai)nilai from trdspp a inner join 
							ms_rek6 b on a.kd_rek6=b.kd_rek6 where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by a.kd_rek6,b.nm_rek6,kd_sub_kegiatan
							
						) tox";
					$hasil1 = $this->db->query($sql1);
					$row1 = $hasil1->row();
					$jumlahbaris = $row1->jumlah;  
					// if($jumlahbaris<=$banyak){
						$sql = "SELECT * from (

							select '1'as urut,left(a.kd_sub_kegiatan,12)as kd_sub_kegiatan,left(a.kd_sub_kegiatan,12) kd_rek,b.nm_kegiatan as nm_rek,sum(nilai)nilai from trdspp a inner join 
							ms_kegiatan b on left(a.kd_sub_kegiatan,12)=b.kd_kegiatan 
							where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by left(a.kd_sub_kegiatan,12),nm_kegiatan
							union all
							select '2'as urut,kd_sub_kegiatan,kd_sub_kegiatan kd_rek,a.nm_sub_kegiatan as nm_rek,sum(nilai)nilai from trdspp a where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by kd_sub_kegiatan,nm_sub_kegiatan
							union all
							select '3'as urut,kd_sub_kegiatan,a.kd_rek6 kd_rek,b.nm_rek6 as nm_rek,sum(nilai)nilai from trdspp a inner join 
							ms_rek6 b on a.kd_rek6=b.kd_rek6 where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd'
							group by a.kd_rek6,b.nm_rek6,kd_sub_kegiatan
							) tox order by urut,kd_rek";
					// }else{
					// 	$sql = "SELECT * from (

					// 		select '1'as urut,left(a.kd_sub_kegiatan,12)as kd_sub_kegiatan,left(a.kd_sub_kegiatan,12) kd_rek,b.nm_kegiatan as nm_rek,sum(nilai)nilai from trdspp a inner join 
					// 		trskpd b on a.kd_sub_kegiatan=b.kd_sub_kegiatan where no_spp='$lcnospp' AND a.kd_skpd='$lckd_skpd' group by left(a.kd_sub_kegiatan,12),nm_kegiatan
					// 	union all
					// 	select '2' as urut, '' as kd_sub_kegiatan, '' kd_rek, '(Rincian Terlampir)' as nm_rek, 0 as nilai
					// 	) tox order by urut,kd_rek";    
					// }
									$hasil = $this->db->query($sql);
									$lcno = 0;
									$lcno_baris = 0;
								   // $lntotal = 0;
									foreach ($hasil->result() as $row)
									{   
										$lcno_baris = $lcno_baris + 1;                                      
										if (strlen($row->kd_rek)>=12){
										//print_r($row);
										//exit();
										$lcno = $lcno + 1;
										$lcno_x = $lcno;
										}
										else {
											$lcno_x ='';
										}
//                                           $lntotal = $lntotal + $row->nilai;
									// $panjang=strlen($row->kd_rek);
									if($row->urut=='3'){

										$cRet .="<tr>
													<td style=\"border-bottom: hidden;\" align=\"center\">&nbsp;$lcno_x</td>
													<td style=\"border-bottom: hidden;\">&nbsp;".$this->supportskpd->dotrek($row->kd_rek)." </td>
													<td style=\"border-bottom: hidden;\">$row->nm_rek</td>
													<td style=\"border-bottom: hidden;\" align=\"right\">".number_format($row->nilai,"2",",",".")."&nbsp;</td>
												</tr>";  

									}else{

										$cRet .="<tr>
													<td style=\"border-bottom: hidden;\" align=\"center\">&nbsp;<b>$lcno_x</b></td>
													<td style=\"border-bottom: hidden;\">&nbsp;<b>".$row->kd_rek." </b></td>
													<td style=\"border-bottom: hidden;\"><b>$row->nm_rek</b></td>
													<td style=\"border-bottom: hidden;\" align=\"right\"><b>".number_format($row->nilai,"2",",",".")."&nbsp;</b></td>
												</tr>";  

									}
										 
									
										
									}
									if($lcno_baris<=$banyak)
								   {
									 for ($i = $lcno_baris; $i <= $banyak; $i++) 
									  {
										$cRet .="<tr>
													<td style=\"border-top: hidden;\" align=\"center\">&nbsp;</td>
													<td style=\"border-top: hidden;\" ></td>
													<td style=\"border-top: hidden;\"></td>
													<td style=\"border-top: hidden;\" align=\"right\"></td>
												</tr>";    
									  }                                                   
								   }
								   
			}     
		 $cRet .="<tr>
					<td align=\"right\" colspan=\"3\">&nbsp;<b>JUMLAH&nbsp;</b></td>
					<td align=\"right\"><b>".number_format($lntotal,"2",",",".")."</b>&nbsp;</td>
				</tr>
				</table>
				<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:11px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
					<td colspan=\"4\">&nbsp;Potongan-potongan</td>
				</tr>
				<tr>
					<td  width=\"5%\" align=\"center\"><b>NO</b></td>
					<td  width=\"65%\" align=\"center\"><b>Uraian (No.Rekening)</b></td>
					<td  width=\"15%\" align=\"center\"><b>Jumlah(Rp)</b></td>
					<td  width=\"15%\" align=\"center\"><b>Keterangan</b></td>
				</tr>";
				
				$sql = "select a.* from trspmpot a inner join ms_pot b on a.map_pot=b.map_pot where no_spm='$lcnospm' AND kelompok='1' AND kd_skpd='$lckd_skpd'";
						$hasil = $this->db->query($sql);
						$lcno = 0;
						$lntotalpot = 0;
						foreach ($hasil->result() as $row){
						   $lcno = $lcno + 1;
						   $lntotalpot = $lntotalpot + $row->nilai;
							$cRet .="<tr>
										<td align=\"center\">&nbsp;$lcno</td>
										<td>&nbsp; ".$this->supportskpd->dotrek($row->kd_rek6)." $row->nm_rek6</td>
										<td align=\"right\">".number_format($row->nilai,"2",",",".")."&nbsp;</td>
										<td>&nbsp;</td>
									</tr>";    
						}
						if($lcno<=4)
								   {
									 for ($i = $lcno; $i < 4; $i++) 
									  {
										$cRet .= "<tr>
													<td>&nbsp;</td>
													<td></td>
													<td></td>
													<td></td>
												 </tr>";    
									  }                                                   
								   }
									
				$cRet .="
				<tr>
					<td>&nbsp;</td>
					<td align=\"right\"><b>Jumlah</b>&nbsp;</td>
					<td align=\"right\"><b>".number_format($lntotalpot,"2",",",".")."</b>&nbsp;</td>
					<td></td>
				</tr>
				 <tr>
					<td colspan=\"4\">&nbsp;Informasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>(tidak mengurangi jumlah pembayaran SP2D)</i></td>
				</tr>
		
				<tr>
					<td align=\"center\"><b>NO</b></td>
					<td align=\"center\"><b>Uraian (No.Rekening)</b></td>
					<td align=\"center\"><b>Jumlah(Rp)</b></td>
					<td align=\"center\"><b>Keterangan</b></td>
				</tr>";
				 
				$sql = "SELECT a.* from trspmpot a inner join ms_pot b on a.map_pot=b.map_pot where no_spm='$lcnospm' AND kelompok='2' AND kd_skpd='$lckd_skpd'" ;

						$hasil = $this->db->query($sql);
						$lcno = 0;
						$lntotalpott = 0;
						foreach ($hasil->result() as $row)
						{
						   $lcno = $lcno + 1;
						   $lntotalpott = $lntotalpott + $row->nilai;
						   $kode_rek=$row->kd_rek6;
						   // if($kode_rek=='2130101'){
						   //     $nama_rek='PPh 21';
						   // } else if ($kode_rek=='2130201'){
						   //     $nama_rek='PPh 22';
						   // } else if($kode_rek=='2130301'){
						   //     $nama_rek='PPN';
						   // } else if($kode_rek=='2130401'){
						   //     $nama_rek='PPh 23';
						   // } else if($kode_rek=='2130501'){
						   //     $nama_rek='PPh Pasal 4';
						   // } else{
								$nama_rek=$row->nm_rek6;
						   // }
						   $cRet .="<tr>
										<td align=\"center\">&nbsp;$lcno</td>
										<td> &nbsp;".$this->supportskpd->dotrek($kode_rek)." $nama_rek</td>
										<td align=\"right\">".number_format($row->nilai,"2",",",".")."&nbsp;</td>
										<td>&nbsp;</td>
									</tr>";    
						}
						if($lcno<=4)
								   {
									 for ($i = $lcno; $i < 4; $i++) 
									  {
										$cRet .= "<tr>
													<td>&nbsp;</td>
													<td></td>
													<td></td>
													<td></td>
												 </tr>";    
									  }                                                   
								   }
						
						
						
						$jum_bayar=strval($lntotal-$lntotalpot);
						$bil_bayar = strval($lntotal-($lntotalpot+$lntotalpott));
				$cRet .="
				<tr>
					<td>&nbsp;</td>
					<td align=\"right\"><b>Jumlah</b>&nbsp;</td>
					<td align=\"right\"><b>".number_format($lntotalpott,"2",",",".")."</b>&nbsp;</td>
					<td></td>
				</tr>
				 
			</table>  
		</td>
	</tr>
	<tr>
		<td colspan=\"2\">
			<table style=\"border-collapse:collapse;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
			   <tr>
					<td colspan=\"4\" valign=\"bottom\" style=\"font-weight: bold;\">&nbsp;SP2D yang Dibayarkan</td>
				</tr>
			   <tr>
			   
					<td width=\"67%\" align=\"left\">&nbsp;Jumlah yang Diminta</td>
					<td   align=\"left\" colspan=\"2\">&nbsp;Rp</td>
					<td style=\"border-left: hidden;\"  align=\"right\">".number_format($lntotal,"2",",",".")."&nbsp;</td>
					</tr>
				<tr > 
					<td align=\"left\">&nbsp;Jumlah Potongan</td>
					<td  align=\"left\" colspan=\"2\">&nbsp;Rp</td>
					<td style=\"border-left: hidden;\" align=\"right\">".number_format($lntotalpot+$lntotalpott,"2",",",".")."&nbsp;</td>
				</tr>
				<tr style=\"font-weight: bold;\">
					<td align=\"left\">&nbsp;<b>Jumlah yang Dibayarkan</b></td>
					<td  align=\"left\" colspan=\"2\"><b>&nbsp;Rp</b></td>
					
					<td style=\"border-left: hidden;\"align=\"right\" >".number_format($lntotal-($lntotalpot+$lntotalpott),"2",",",".")."&nbsp;</td>
				</tr> 

				<tr style=\"font-weight: bold;\">
					<td align=\"left\" colspan=\"3\">&nbsp;<b>Uang Sejumlah :
					(&nbsp;".$this->supportskpd->terbilang($bil_bayar)."&nbsp;)</b></td>
					
					<td style=\"border-left: hidden;\" >&nbsp;</td>
				</tr>                    
			</table>  
		</td>
	</tr>
	
	<tr>
		<td colspan=\"2\">
			<table style=\"border-collapse:collapse;font-weight: bold;font-family: Open Sans;font-size:12px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">
	   
			<tr>
					<td width=\"70%\" align=\"left\" style=\"font-size:10px\" valign=\"top\">
					<br>&nbsp;Lembar 1 : Bank Yang Ditunjuk<br>
					&nbsp;Lembar 2 : Pengguna Anggaran/Kuasa Pengguna Anggaran<br>
					&nbsp;Lembar 3 : Arsip Kuasa BUD<br>
					&nbsp;Lembar 4 : Pihak Penerima<br>
						   
					</td>
					<td width=\"30%\" align=\"center\">
					<br>
					Pontianak, $tanggal<br>
					$jabatan<br>
					<br>
					<br>
					<br>
					<br>
					<u>$nama</u><br>
					NIP. $nip                
					</td>
			   </tr>
			</table>  
		</td>
	</tr>
	
	
	</table>";
	$data['prev']= $cRet;
	echo $cRet  ;  
	// $this->supportskpd->_mpdf_sp2d2('',$cRet,10,5,5,'0');
}
// cetakan sp2d end

public function verifikasi()
{	
	
		$verif 		= $this->input->post('verif', TRUE);
		$id 		= $this->input->post('id', TRUE);
		$username 	= $this->session->userdata('username');
		$curdate	=	date('Y-m-d');
		$this->db->set('is_verified', $verif);
		if($verif==1){
			$this->db->set('user_verif', $username);
			$this->db->set('tgl_verif', $curdate);
		}else{
			$this->db->set('user_batal_verif', $username);
			$this->db->set('tgl_verif', null);
		}
		
		$this->db->where('no_sp2d', $id);
		$result = $this->db->update('trhsp2d');
		if($result){
				echo json_encode(array(
					"statusCode"=>200
				));
		}else{
				echo json_encode(array(
					"statusCode"=>201
				));
		}

	
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
		foreach ($records['data']   as $row) 
		{  

			if ($row['keterangan']=='SUKSES'){
					$keterangan='<span class="badge bg-success">'.$this->security->xss_clean($row['keterangan']).'</span>';
				}else{
					$keterangan='<span class="badge bg-danger">'.$this->security->xss_clean($row['keterangan']).'</span>';
				}

			$data[]= array(
				++$i,
				$this->security->xss_clean($row['kd_rek6']),
				$this->security->xss_clean($row['nm_rek6']),
				$this->security->xss_clean($this->sp2d_model->formatbilling($row['idBilling'])),
				$this->security->xss_clean(number_format($row['nilai'],'2','.',','))
			);
		}
		echo json_encode(array(
			// 'draw' =>$this->input->post('draw'),
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
		$id = $this->input->post('no_uji');
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


    function totalpotongan() {
		$nosp2d = $this->input->post('nosp2d');
		$potongan = $this->sp2d_model->TotalPotongan($nosp2d)->result();
		echo json_encode($potongan);
	}
    
}
