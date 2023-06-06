<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
1. tanggal_format_indonesia(a)
2. getBulan(a)
3. dotrek(a)
*/

class supportskpd extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function  tanggal_format_indonesia($tgl)
    {

        $tanggal  = explode('-', $tgl);
        $bulan  = $this->getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2] . ' ' . $bulan . ' ' . $tahun;
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

    function combo_beban($id = '', $script = '')
    {
        $cRet    = '';
        $cRet    = "<select name=\"$id\" id=\"$id\" $script >";
        $cRet   .= "<option value=''>Pilih Beban</option>";
        $cRet   .= "<option value='1'>UP/GU</option>";
        $cRet   .= "<option value='3'>TU</option>";
        $cRet   .= "<option value='4'>GAJI</option>";
        $cRet   .= "<option value='6'>Barang & Jasa</option>";
        $cRet   .= "</select>";
        return $cRet;
    }

    function ambil_kd_bank($keyword)
    {   
        $where = "";
        
        if ($keyword != ''){
            $where = "where nama_bank like '%$keyword%' OR kd_bank like '%$keyword%'";
        }
        $sql = "SELECT * from ms_bank_online $where";
        $query1 = $this->db->query($sql);
        $result = array();
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {

            $result[] = array(
                'id' => $ii,
                'kode' => $resulte['kd_bank'],
                'nama' => $resulte['nama_bank'],
                'bic' => $resulte['bic'],
            );
            $ii++;
        }

        return $result;
    }
    function cek_tgl_spp_terakhir()
    {
        $skpd     = $this->session->userdata('kdskpd');
        $sql = "SELECT FORMAT (max(tgl_spp), 'yyyy-M-d') as tgl_spp from trhspp where kd_skpd ='$skpd' and (sp2d_batal is null or sp2d_batal= '0'";
        $query1 = $this->db->query($sql);
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {
            $result = array(
                'id' => $ii,
                'tgl_spp' => $resulte['tgl_spp']
            );
            $ii++;
        }
        return json_encode($result);
    }

    function ambil_cabang($kodebank,$keyword)
    {   
        $where="";
        if ($keyword != ''){
            $where = "and (nama like '%$keyword%')";
        }
        $sql = "SELECT * from ms_bank where bic='$kodebank' $where";
        $query1 = $this->db->query($sql);
        $result = array();
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {

            $result[] = array(
                'id' => $ii,
                'kode' => $resulte['kode'],
                'nama' => $resulte['nama'],
            );
            $ii++;
        }

        return $result;
    }

    function ambil_akun()
    {
        $sql = "SELECT kd_map,nm_map from ms_map_billing group by kd_map,nm_map";
        $query1 = $this->db->query($sql);
        $result = array();
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {

            $result[] = array(
                'id' => $ii,
                'kode' => $resulte['kd_map'],
                'nama' => $resulte['nm_map'],
            );
            $ii++;
        }

        return $result;
    }

    function ambil_setor($kodeakun)
    {
        $sql = "SELECT * from ms_map_billing where kd_map='$kodeakun'";
        $query1 = $this->db->query($sql);
        $result = array();
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {

            $result[] = array(
                'id' => $ii,
                'kode'          => $resulte['kd_setor'],
                'nama'          => $resulte['nm_setor'],
                'masa_bulan'    => $resulte['masa_bulan'],
                'masa_tahun'    => $resulte['masa_tahun'],
                'mata_uang'     => $resulte['mata_uang'],
                'wp_badan'      => $resulte['wp_badan'],
                'wp_pemungut'   => $resulte['wp_pemungut'],
                'wp_op'         => $resulte['wp_op'],
                'npwp_nol'      => $resulte['npwp_nol'],
                'npwp_lain'     => $resulte['npwp_lain'],
                'butuh_nop'     => $resulte['butuh_nop'],
                'butuh_nosk'    => $resulte['butuh_nosk'],
                'npwp_rekanan'  => $resulte['npwp_rekanan'],
                'nik_rekanan'   => $resulte['nik_rekanan'],
                'no_faktur'     => $resulte['no_faktur'],
                'no_skpd'       => $resulte['no_skpd'],
                'no_spm'        => $resulte['no_spm']

            );
            $ii++;
        }

        return $result;
    }
    function get_status_angkas($skpd)
    {
        $n_status = '';

        $sql = "SELECT TOP 1 * from (
select '1'as urut,'murni' as status,murni as nilai from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '2'as urut,'murni_geser1',murni_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '3'as urut,'murni_geser2',murni_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '4'as urut,'murni_geser3',murni_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '5'as urut,'murni_geser4',murni_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '6'as urut,'murni_geser5',murni_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '7'as urut,'sempurna1',sempurna1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '8'as urut,'sempurna1_geser1',sempurna1_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '9'as urut,'sempurna1_geser2',sempurna1_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '10'as urut,'sempurna1_geser3',sempurna1_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '11'as urut,'sempurna1_geser4',sempurna1_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '12'as urut,'sempurna1_geser5',sempurna1_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '13'as urut,'sempurna2',sempurna2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '14'as urut,'sempurna2_geser1',sempurna2_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '15'as urut,'sempurna2_geser2',sempurna2_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '16'as urut,'sempurna2_geser3',sempurna2_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '17'as urut,'sempurna2_geser4',sempurna2_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '18'as urut,'sempurna2_geser5',sempurna2_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '19'as urut,'sempurna3',sempurna3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '20'as urut,'sempurna3_geser1',sempurna3_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '21'as urut,'sempurna3_geser2',sempurna3_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '22'as urut,'sempurna3_geser3',sempurna3_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '23'as urut,'sempurna3_geser4',sempurna3_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '24'as urut,'sempurna3_geser5',sempurna3_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '25'as urut,'sempurna4',sempurna4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '26'as urut,'sempurna4_geser1',sempurna4_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '27'as urut,'sempurna4_geser2',sempurna4_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '28'as urut,'sempurna4_geser3',sempurna4_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '29'as urut,'sempurna4_geser4',sempurna4_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '30'as urut,'sempurna4_geser5',sempurna4_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '31'as urut,'sempurna5',sempurna5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '32'as urut,'sempurna5_geser1',sempurna5_geser1 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '33'as urut,'sempurna5_geser2',sempurna5_geser2 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '34'as urut,'sempurna5_geser3',sempurna5_geser3 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '35'as urut,'sempurna5_geser4',sempurna5_geser4 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '36'as urut,'sempurna5_geser5',sempurna5_geser5 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '37'as urut,'ubah',ubah from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '38'as urut,'ubah11',ubah11 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '39'as urut,'ubah12',ubah12 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '40'as urut,'ubah13',ubah13 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '41'as urut,'ubah14',ubah14 from status_angkas where kd_skpd ='$skpd'
UNION ALL
select '42'as urut,'ubah15',ubah15 from status_angkas where kd_skpd ='$skpd'
)zz where nilai='1' ORDER BY cast(urut as int) DESC";

        $q_trhrka = $this->db->query($sql);
        $num_rows = $q_trhrka->num_rows();

        foreach ($q_trhrka->result() as $r_trhrka) {
            $n_status = $r_trhrka->status;
        }
        return $n_status;
    }
    function get_angkas_selisih($status_angkas = '', $status_anggaran = '')
    {
        $skpd               = $this->session->userdata('kdskpd');
        $status_angkas      = $this->get_status_angkas($skpd);
        $status_anggaran    = $this->get_status_anggaran();
        $kolom              = $this->get_nama($status_angkas, 'kode', 'tb_status_angkas', 'status_kunci');
        $sql                = "SELECT count(*)as jumlah from (
                        select kd_skpd,kd_sub_kegiatan,kd_rek6,nilai as anggaran,
                        (select sum(nilai_$kolom) from trdskpd_ro where kd_skpd=z.kd_skpd and kd_sub_kegiatan=z.kd_sub_kegiatan and kd_rek6=z.kd_rek6)as angkas
                        from trdrka z where jns_ang='$status_anggaran')zz where anggaran-angkas<>0 and kd_skpd ='$skpd'";
        $query1 = $this->db->query($sql);
        $ii = 0;

        foreach ($query1->result() as $resulte) {

            $jumlah = $resulte->jumlah;
        }
        return $jumlah;
    }

    function spj_tahunlalu($lcskpd = '', $nbulan)
    {
        $hasil = '';
        $csql = "SELECT SUM(ISNULL(jlain_up_ll,0)) jlain_up_ll, SUM(ISNULL(jlain_up_ini,0)) jlain_up_ini, 
                 SUM(ISNULL(jlain_up_pjkll,0)) jlain_up_pjkll, SUM(ISNULL(jlain_up_pjkini,0)) jlain_up_pjkini FROM(   
                    SELECT 
                    SUM(CASE WHEN a.jns_beban ='1' AND MONTH(a.tgl_bukti)<'$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_ll,
                    SUM(CASE WHEN a.jns_beban ='1' AND MONTH(a.tgl_bukti)='$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_ini,
                    SUM(CASE WHEN a.jns_beban ='7' AND MONTH(a.tgl_bukti)<'$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_pjkll,
                    SUM(CASE WHEN a.jns_beban ='7' AND MONTH(a.tgl_bukti)='$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_pjkini
                    FROM TRHOUTLAIN a 
                    WHERE a.kd_skpd='$lcskpd' and thnlalu=1
                ) a ";
        $hasil = $this->db->query($csql);
        return $hasil;
    }

    function spjorg_tahunlalu($lcskpd = '', $nbulan)
    {
        $hasil = '';
        $csql = "SELECT SUM(ISNULL(jlain_up_ll,0)) jlain_up_ll, SUM(ISNULL(jlain_up_ini,0)) jlain_up_ini, 
                 SUM(ISNULL(jlain_up_pjkll,0)) jlain_up_pjkll, SUM(ISNULL(jlain_up_pjkini,0)) jlain_up_pjkini FROM(   
                    SELECT 
                    SUM(CASE WHEN a.jns_beban ='1' AND MONTH(a.tgl_bukti)<'$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_ll,
                    SUM(CASE WHEN a.jns_beban ='1' AND MONTH(a.tgl_bukti)='$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_ini,
                    SUM(CASE WHEN a.jns_beban ='7' AND MONTH(a.tgl_bukti)<'$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_pjkll,
                    SUM(CASE WHEN a.jns_beban ='7' AND MONTH(a.tgl_bukti)='$nbulan' THEN  a.nilai ELSE 0 END) AS jlain_up_pjkini
                    FROM TRHOUTLAIN a 
                    WHERE left(a.kd_skpd,17)=left('$lcskpd',17) and thnlalu=1
                ) a ";
        $hasil = $this->db->query($csql);
        return $hasil;
    }

    function get_status_anggaran()
    {
        $n_status = '';
        $skpd       = $this->session->userdata('kdskpd');
        $sql = "SELECT TOP 1 * from trhrka where kd_skpd ='$skpd' and status='1' order by tgl_dpa DESC";

        $q_trhrka = $this->db->query($sql);
        $num_rows = $q_trhrka->num_rows();

        foreach ($q_trhrka->result() as $r_trhrka) {
            $n_status = $r_trhrka->jns_ang;
        }
        return $n_status;
    }

    function get_nama2($kode, $hasil, $tabel, $field, $field2, $kode2)
    {
        $this->db->select($hasil);
        $this->db->where($field, $kode);
        $this->db->where($field2, $kode2);
        $q = $this->db->get($tabel);
        $data  = $q->result_array();
        $baris = $q->num_rows();
        return $data[0][$hasil];
    }

    function cek_status_ang_new()
    {
        $skpd       = $this->session->userdata('kdskpd');
        $sql        = "SELECT TOP 1 * from trhrka a inner join tb_status_anggaran b ON a.jns_ang=b.kode where a.kd_skpd ='$skpd' and status='1' order by tgl_dpa DESC";
        $query1 = $this->db->query($sql);
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {
            $result = array(
                'id' => $ii,
                'status_ang' => $resulte['nama'],
                "jns_ang" => $resulte['jns_ang']
            );
            $ii++;
        }
        return json_encode($result);
    }

    function cek_status_ang()
    {
        $skpd     = $this->session->userdata('kdskpd');
        $sql = "SELECT 
                case 
                when status_ubah2       =1  then 'nilai_ubah'
                when status_ubah        =1  then 'nilai_ubah'
                when status_sempurna5   =1  then 'nilaisempurna5' 
                when status_sempurna4   =1  then 'nilaisempurna4' 
                when status_sempurna3   =1  then 'nilaisempurna3'
                when status_sempurna2   =1  then 'nilaisempurna2'
                when status_sempurna    =1  then 'nilaisempurna1'
                else 'nilai' end as anggaran 
                from trhrka where kd_skpd ='$skpd'";
        $query1 = $this->db->query($sql);
        $ii = 0;
        foreach ($query1->result_array() as $resulte) {
            $result = array(
                'id' => $ii,
                'status_ang' => $resulte['anggaran']
            );
            $ii++;
        }
        return json_encode($result);
    }
    function  tanggal_indonesia($tgl)
    {
        $tanggal  =  substr($tgl, 8, 2);
        $bulan  = substr($tgl, 5, 2);
        $tahun  =  substr($tgl, 0, 4);
        return  $tanggal . '-' . $bulan . '-' . $tahun;
    }
    function rp_minus($nilai)
    {
        if ($nilai < 0) {
            $nilai = $nilai * (-1);
            $nilai = '(' . number_format($nilai, "2", ",", ".") . ')';
        } else {
            $nilai = number_format($nilai, "2", ",", ".");
        }

        return $nilai;
    }

    function nvl($val, $replace)
    {
        if (is_null($val) || $val === '')
            return $replace;
        else
            return $val;
    }

    function get_nama($kode, $hasil, $tabel, $field)
    {
        $this->db->select($hasil);
        $this->db->where($field, $kode);
        $q = $this->db->get($tabel);
        $data  = $q->result_array();
        $baris = $q->num_rows();
        return $data[0][$hasil];
    }

    function  getBulan($bln)
    {
        switch ($bln) {
            case  1:
                return  "Januari";
                break;
            case  2:
                return  "Februari";
                break;
            case  3:
                return  "Maret";
                break;
            case  4:
                return  "April";
                break;
            case  5:
                return  "Mei";
                break;
            case  6:
                return  "Juni";
                break;
            case  7:
                return  "Juli";
                break;
            case  8:
                return  "Agustus";
                break;
            case  9:
                return  "September";
                break;
            case  10:
                return  "Oktober";
                break;
            case  11:
                return  "November";
                break;
            case  12:
                return  "Desember";
                break;
        }
    }
    function right($value, $count)
    {
        return substr($value, ($count * -1));
    }

    function left($string, $count)
    {
        return substr($string, 0, $count);
    }
    function _mpdf_sp2d2($judul = '', $isi = '', $lMargin = '', $rMargin = '', $font = 0, $orientasi = '')
    {

        ini_set("memory_limit", "-1");
        ini_set("MAX_EXECUTION_TIME", "-1");
        $this->load->library('mpdf');


        $this->mpdf->defaultheaderfontsize = 6; /* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;   /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6; /* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;   /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1;
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        $jam = date("H:i:s");
        $this->mpdf = new mPDF('utf-8', array(215.9, 330.2), $size); //folio
        $this->mpdf->AddPage($orientasi, '', '', 1, 1, $lMargin, $rMargin, 15, 5);
        //$this->mpdf->SetFooter("Printed on Simakda || Halaman {PAGENO} ");
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
        $this->mpdf->Output();
    }
    function  dotrek($rek)
    {
        $nrek = strlen($rek);
        switch ($nrek) {
            case 1:
                $rek = $this->left($rek, 1);
                break;
            case 2:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1);
                break;
            case 4:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1) . '.' . substr($rek, 2, 2);
                break;
            case 6:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1) . '.' . substr($rek, 2, 2) . '.' . substr($rek, 4, 2);
                break;
            case 8:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1) . '.' . substr($rek, 2, 2) . '.' . substr($rek, 4, 2) . '.' . substr($rek, 6, 2);
                break;
            case 11:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1) . '.' . substr($rek, 2, 2) . '.' . substr($rek, 4, 2) . '.' . substr($rek, 6, 2) . '.' . substr($rek, 8, 12);;
                break;
            case 12:
                $rek = $this->left($rek, 1) . '.' . substr($rek, 1, 1) . '.' . substr($rek, 2, 2) . '.' . substr($rek, 4, 2) . '.' . substr($rek, 6, 2) . '.' . substr($rek, 8, 4);;
                break;
            default:
                $rek = "";
        }
        return $rek;
    }

    function auto_cek_status($skpd)
    {
        $tgl_spp = $this->input->post('tgl_cek');
        $sql = "SELECT top 1 
                case 
                when statu=1 and status_sempurna=1 and status_ubah=1  then 'ubah'
                when statu=1 and status_sempurna=1 and status_ubah=0  then 'geser' 
                when statu=1 and status_sempurna=0 and status_ubah=0  then 'murni' 
                when statu=1 and status_sempurna=0 and status_ubah=1  then 'murni'
                else 'murni' end as anggaran from trhrka where left(kd_skpd,17) =left('$skpd',17)";
        //  echo "$sql";
        $query1 = $this->db->query($sql);
        $ii = 0;
        foreach ($query1->result() as $resulte) {
            $status_ang = $resulte->anggaran;
        }
        return $status_ang;
    }

    function sort($id = '', $tbl = '')
    {
        if ($tbl == '') {
            $tabel = '';
        } else {
            $tabel = "$tbl" . ".";
        }
        return $sort = substr($id, 0, 4) == '1.02' || substr($id, 0, 4) == '7.01' ? "{$tabel}kd_skpd='$id'" : "left({$tabel}kd_skpd,17)=left('$id',17)";
    }

    function _mpdf_down($judul = '', $nm_giat = '', $isi = '', $lMargin = '', $rMargin = '', $font = 10, $orientasi = '', $hal = '', $tab = '', $jdlsave = '', $tMargin = '')
    {


        ini_set("memory_limit", "-1");
        $this->load->library('mpdf');
        //$this->mpdf->SetHeader('||Halaman {PAGENO} /{nb}');


        $this->mpdf->defaultheaderfontsize = 6; /* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;   /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 1; /* in pts */
        $this->mpdf->defaultfooterfontstyle = blank;    /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0;
        $sa = 1;
        $tes = 0;
        if ($hal == '') {
            $hal1 = 1;
        }
        if ($hal !== '') {
            $hal1 = $hal;
        }

        if ($tMargin == '') {
            $tMargin = 16;
        }

        if ($lMargin == '') {
            $lMargin = 15;
        }

        if ($rMargin == '') {
            $rMargin = 15;
        }

        $judulx = $judul . '-' . $nm_giat . '.pdf';
        $this->mpdf = new mPDF('utf-8', array(215, 330), $size, '', $lMargin, $rMargin, $tMargin); //folio

        $mpdf->cacheTables = true;
        $mpdf->packTableData = true;
        $mpdf->simpleTables = true;
        $this->mpdf->AddPage($orientasi, '', $hal1, '1', 'off');
        if (!empty($tab)) $this->mpdf->SetTitle($tab);
        if ($hal != 'no') {
            ///$this->mpdf->SetFooter("Halaman {PAGENO}  ");
            $this->mpdf->SetFooter("Printed on Simakda || Halaman {PAGENO}  ");
        }
        if (!empty($judulx)) $this->mpdf->writeHTML('');
        //$this->mpdf->simpleTables= true;     
        $this->mpdf->writeHTML($isi);
        //$this->mpdf->Output('');
        $this->mpdf->Output($judulx, 'D');
    }

    function _mpdf2($judul = '', $nm_giat = '', $isi = '', $lMargin = '', $rMargin = '', $font = 10, $orientasi = '', $hal = '', $tab = '', $jdlsave = '', $tMargin = '')
    {


        ini_set("memory_limit", "-1");
        $this->load->library('mpdf');
        //$this->mpdf->SetHeader('||Halaman {PAGENO} /{nb}');


        $this->mpdf->defaultheaderfontsize = 6; /* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;   /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 1; /* in pts */
        $this->mpdf->defaultfooterfontstyle = blank;    /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 0;
        $sa = 1;
        $tes = 0;
        if ($hal == '') {
            $hal1 = 1;
        }
        if ($hal !== '') {
            $hal1 = $hal;
        }

        if ($tMargin == '') {
            $tMargin = 16;
        }

        if ($lMargin == '') {
            $lMargin = 15;
        }

        if ($rMargin == '') {
            $rMargin = 15;
        }

        $judulx = $judul . '-' . $nm_giat . '.pdf';
        $this->mpdf = new mPDF('utf-8', array(215, 330), $size, '', $lMargin, $rMargin, $tMargin); //folio

        $mpdf->cacheTables = true;
        $mpdf->packTableData = true;
        $mpdf->simpleTables = true;
        $this->mpdf->AddPage($orientasi, '', $hal1, '1', 'off');
        if (!empty($tab)) $this->mpdf->SetTitle($tab);
        if ($hal != 'no') {
            ///$this->mpdf->SetFooter("Halaman {PAGENO}  ");
            $this->mpdf->SetFooter("Printed on Simakda || Halaman {PAGENO}  ");
        }
        if (!empty($judulx)) $this->mpdf->writeHTML('');
        //$this->mpdf->simpleTables= true;     
        $this->mpdf->writeHTML($isi);
        //$this->mpdf->Output('');
        $this->mpdf->Output();
    }


    function _mpdf1($judul = '', $isi = '', $lMargin = 10, $rMargin = 10, $font = '', $orientasi = '', $hal = '', $fonsize = '')
    {


        ini_set("memory_limit", "-1M");
        ini_set("MAX_EXECUTION_TIME", "-1");
        $this->load->library('mpdf');
        //$this->mpdf->SetHeader('||Halaman {PAGENO} /{nb}');


        $this->mpdf->defaultheaderfontsize = 10;    /* in pts */
        $this->mpdf->defaultheaderfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 3; /* in pts */
        $this->mpdf->defaultfooterfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1;
        $sa = 1;
        $tes = 0;
        if ($hal == '') {
            $hal1 = 1;
        }
        if ($hal !== '') {
            $hal1 = $hal;
        }
        if ($fonsize == '') {
            $size = 12;
        } else {
            $size = $fonsize;
        }

        $this->mpdf = new mPDF('utf-8', array(215, 330), $size); //folio
        //$this->mpdf->useOddEven = 1;                      

        $this->mpdf->AddPage($orientasi, '', $hal, '1', 'off');
        if ($hal == '') {
            $this->mpdf->SetFooter("");
        } else {
            $this->mpdf->SetFooter("Printed on Simakda || Halaman {PAGENO}  ");
        }
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
        $this->mpdf->Output();
    }

    function cek_status_spj($kd_skpd)
    {
        $hasil = '0';
        $sql = "select top 1 Cast([bulan] as INT) [bulan] from trhspj_ppkd where kd_skpd='$kd_skpd' and cek='1' order by Cast([bulan] as INT) desc";
        $query1 = $this->db->query($sql);
        foreach ($query1->result_array() as $res) {
            $hasil = $res['bulan'];
        }
        return $hasil;
    }

    function cek_sisa_spd_lpj($skpd, $jns, $nospp, $no_bukti, $tgl, $jnsspp = '')
    {
        $hasil  = 0;

        $csql = "SELECT spd,keluar1 = keluar-terima,keluarspp  from(
                        select sum(spd) as spd,sum(terima) as terima,sum(keluar) as keluar,sum(keluarspp) as keluarspp from(";

        //--------------------------------------Hitung Nilai SPD
        if ($tgl != '') {
            $csql1 = "	SELECT 'SPD' as ket,isnull(sum(nilai),0) as spd,0 as terima,0 as keluar,0 as keluarspp from trhspd d join trdspd e on d.no_spd=e.no_spd 
                            where d.kd_skpd='$skpd' and d.status='1' and d.jns_beban='$jns' and d.tgl_spd<='$tgl'";
        } else {
            $csql1 = "	SELECT 'SPD' as ket,isnull(sum(nilai),0) as spd,0 as terima,0 as keluar,0 as keluarspp from trhspd d join trdspd e on d.no_spd=e.no_spd 
                            where d.kd_skpd='$skpd' and d.status='1' and d.jns_beban='$jns'";
        }
        //-------------------------------------Realisasi SPJ 
        $csql2 = "		UNION ALL
                            SELECT 'SPP' as ket,0 as spd,0 as terima,isnull(sum(a.nilai),0) [keluar],0 as keluarspp from trdspp a join trhspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
                            where LEFT(kd_rek6,1)='$jns' and b.jns_spp in ('3','4','5','6') and left(a.kd_skpd,17)=left('$skpd',17) and b.no_spp<>'$nospp' and (sp2d_batal is null or sp2d_batal <>'1')
                            union all
                            select 'Trans UP/GU' as ket,0 as spd,0 as terima,isnull(sum(a.nilai),0) [keluar],0 as keluarspp from trdtransout a join trhtransout b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd
                            where LEFT(kd_rek6,1)='$jns' and b.jns_spp in ('1','2') and left(a.kd_skpd,17)=left('$skpd',17) and a.no_bukti<>'$no_bukti'
                            union all
                            select 'Trans UP/GU CMS' as ket,0 as spd,0 as terima,isnull(sum(a.nilai),0) [keluar],0 as keluarspp from trdtransout_cmsbank a join trhtransout_cmsbank b on a.no_voucher=b.no_voucher 
                            and a.kd_skpd=b.kd_skpd where LEFT(kd_rek6,1)='$jns' and b.jns_spp in ('1','2') and left(a.kd_skpd,17)=left('$skpd',17) and status_validasi<>'1'";
        //-------------------------------------Realisasi SPJ Tambahan Untuk BL
        $csql3 = "		union all
                            select 'Panjar' as ket,0 as spd,0 as terima,ISNULL(sum(nilai),0) as keluar,0 as keluarspp from tr_panjar where jns='1' and left(kd_skpd,17)=left('$skpd',17) and no_kas<>'$no_bukti'
                            union all
                            select 'T/P Panjar' as ket,0 as spd,ISNULL(sum(nilai),0) as terima,0 as keluar,0 as keluarspp from tr_jpanjar where left(kd_skpd,17)=left('$skpd',17) and no_kas<>'$no_bukti'";

        //------------------------------------Realisasi Berdasarkan SPP	BL	UP/GU/TU/LS	
        $csql4 = "		union all
                            select 'SPP' as ket,0 as spd,0 as terima,0 as keluar,isnull(sum(a.nilai),0) [keluarspp] from trdspp a join trhspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
                            where b.jns_spp in ('1','2','3','6') and left(a.kd_skpd,17)=left('$skpd',17) and b.no_spp<>'$nospp' and (sp2d_batal is null or sp2d_batal <>'1')";

        //------------------------------------Realisasi Berdasarkan SPP	BTL					
        $csql5 = "		union all
                            select 'SPP' as ket,0 as spd,0 as terima,0 as keluar,isnull(sum(a.nilai),0) [keluarspp] from trdspp a join trhspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
                            where b.jns_spp in ('4') and left(a.kd_skpd,17)=left('$skpd',17) and b.no_spp<>'$nospp' and (sp2d_batal is null or sp2d_batal <>'1')";


        $csql6 = "	)as f
                    )as g";

        if ($jnsspp == 'GU') {
            //-------------------------Proteksi LPJ & SPP GU 
            $hasil = $this->db->query($csql . $csql1 . $csql4 . $csql6);
        } else {
            //---------------------------Proteksi di Transaksi Tunai/CMS/ Pemindahbukuan
            if ($jnsspp == 'trans') {
                if ($jns == '5')
                    $hasil = $this->db->query($csql . $csql1 . $csql2 . $csql3 . $csql6);
                else {
                    $hasil = $this->db->query($csql . $csql1 . $csql6);
                }
            } else {
                //-------------------------Proteksi SPP Selain GU
                if ($jns == '5')
                    $hasil = $this->db->query($csql . $csql1 . $csql2 . $csql3 . $csql4 . $csql6);
                else {
                    $hasil = $this->db->query($csql . $csql1 . $csql5 . $csql6);
                }
            }
            //--------------------------------------------------------------------		   
        }
        return $hasil;
    }


    function cek_kendali_skpd($skpd)
    {
        $hasil  = 0;

        $csql = "SELECT * from tb_kendali_lpj where kd_skpd='$skpd'";

        $hasil = $this->db->query($csql);

        return $hasil;
    }

    function _mpdf($judul = '', $isi = '', $lMargin = 10, $rMargin = 10, $font = '', $orientasi = '', $hal = '', $fonsize = '')
    {


        ini_set("memory_limit", "-1M");
        ini_set("MAX_EXECUTION_TIME", "-1");
        $this->load->library('mpdf');

        $this->mpdf->defaultheaderfontsize = 10;    /* in pts */
        $this->mpdf->defaultheaderfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 3; /* in pts */
        $this->mpdf->defaultfooterfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1;
        $sa = 1;
        $tes = 0;
        if ($hal == '') {
            $hal1 = 1;
        }
        if ($hal !== '') {
            $hal1 = $hal;
        }
        if ($fonsize == '') {
            $size = 12;
        } else {
            $size = $fonsize;
        }

        $this->mpdf = new mPDF('utf-8', array(215, 330), $size); //folio                

        $this->mpdf->AddPage($orientasi, '', $hal, '1', 'off');
        if ($hal == '') {
            $this->mpdf->SetFooter("");
        } else {
            $this->mpdf->SetFooter("Printed on Simakda || Halaman {PAGENO}  ");
        }
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
        $this->mpdf->Output();
    }


    function _mpdf_margin($judul = '', $isi = '', $lMargin = 10, $rMargin = 10, $font = '', $orientasi = '', $hal = '', $fonsize = '', $atas = '', $bawah = '', $kiri = '', $kanan = '')
    {

        ini_set("memory_limit", "-1M");
        ini_set("MAX_EXECUTION_TIME", "-1");
        $this->load->library('mpdf');
        $this->mpdf->defaultheaderfontsize = 10;    /* in pts */
        $this->mpdf->defaultheaderfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1;     /* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 3; /* in pts */
        $this->mpdf->defaultfooterfontstyle = I;    /* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1;
        $sa = 1;
        $tes = 0;
        if ($hal == '') {
            $hal1 = 1;
        }
        if ($hal !== '') {
            $hal1 = $hal;
        }
        if ($fonsize == '') {
            $size = 12;
        } else {
            $size = $fonsize;
        }

        $this->mpdf = new mPDF('utf-8', array(215, 330), $size); //folio
        $this->mpdf->AddPage($orientasi, '', $hal, '1', 'off', $kiri, $kanan, $atas, $bawah);
        if ($hal == '') {
            $this->mpdf->SetFooter("");
        } else {
            $this->mpdf->SetFooter("Printed on Simakda SKPD || Halaman {PAGENO}  ");
        }
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
        $this->mpdf->Output();
    }





    function qangg_sdana($tgl, $skpd, $giat, $kdrek5)
    {
        $status_anggaran    = $this->get_status_anggaran();

        $hasil = '';
        $csql = "SELECT kd_sub_kegiatan,kd_rek6,rtrim(ltrim(sumber1)) [sumber],nsumber1 [nilai_sumber]  
                from trdrka  where kd_skpd='$skpd' and kd_sub_kegiatan='$giat' and kd_rek6='$kdrek5' and rtrim(ltrim(sumber1))<>'' and jns_ang='$status_anggaran'
                union all
                select kd_sub_kegiatan,kd_rek6,rtrim(ltrim(sumber2)) [sumber],nsumber2 [nilai_sumber] 
                from trdrka  where kd_skpd='$skpd' and kd_sub_kegiatan='$giat' and kd_rek6='$kdrek5' and rtrim(ltrim(sumber2))<>'' and jns_ang='$status_anggaran'
                union all
                select kd_sub_kegiatan,kd_rek6,ltrim(sumber3) [sumber],nsumber3 [nilai_sumber]
                from trdrka  where kd_skpd='$skpd' and kd_sub_kegiatan='$giat' and kd_rek6='$kdrek5' and rtrim(ltrim(sumber3))<>'' and jns_ang='$status_anggaran'
                union all
                select kd_sub_kegiatan,kd_rek6,rtrim(ltrim(sumber4)) [sumber],nsumber4 [nilai_sumber]
                from trdrka  where kd_skpd='$skpd' and kd_sub_kegiatan='$giat' and kd_rek6='$kdrek5' and ltrim(ltrim(sumber4))<>'' and jns_ang='$status_anggaran' ";
        $hasil = $this->db->query($csql);
        return $hasil;
    }

    function qtrans_sdana($sumber, $giat, $rek, $skpd, $nobkuk)
    {
        $hasil  = 0;
        $csql = "SELECT sum(nilai) [total] from (
                    select 'spp' [jdl],sum(isnull(b.nilai,0)) [nilai] from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd
                    where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek'  and jns_spp not in ('1','2') AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL) and b.sumber='$sumber'
                    UNION ALL
                    select 'tagih' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] from trhtagih a join trdtagih b on a.no_bukti=b.no_bukti 
                    and a.kd_skpd=b.kd_skpd
                    where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek='$rek' and b.no_bukti not in (select no_tagih from trhspp where kd_skpd='$skpd') and b.sumber='$sumber'
                    UNION ALL
                    select 'trans' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai]  from trhtransout a join trdtransout b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd
					where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' and jns_spp  in ('1') and a.no_bukti not in('$nobkuk') and b.sumber='$sumber'
                ) as gabung ";
        $hasil = $this->db->query($csql);
        return $hasil;
    }

    function qtrans_sdana2($sumber, $giat, $rek, $skpd, $nobkuk, $nosp2d, $nospp, $jnsbeban)
    {
        $hasil  = 0;
        if ($jnsbeban == '1') {

            $csql = "SELECT sum(nilai) [total] from (
select 'tagih' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] from trhtagih a 
join trdtagih b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd where
 b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' 
and b.kd_rek='$rek' 
 and b.no_bukti not in (select no_tagih from trhspp where kd_skpd='$skpd') 
and b.sumber='$sumber' 

union all 

 select 'spp' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' 
and jns_spp not in ('1','2') and b.sumber='$sumber' and a.no_spp='$nospp' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
 AND a.no_spp not in (select no_spp from trhsp2d where kd_skpd='$skpd' and jns_spp not in ('1','2') 

 )  

union all 

 select 'sp2d terbit' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' 
and a.jns_spp not in ('1','2') and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and (no_kas_bud='' OR no_kas_bud is null)

UNION ALL

 select 'sp2d cair not trx cms' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' 
and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and no_kas_bud='1' 
 and no_sp2d not in (select no_sp2d from trhtransout_cmsbank where kd_skpd='$skpd' 
 and (status_validasi='0' OR status_validasi is null) )


UNION ALL

select 'sp2d cair not trx' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' 
and a.jns_spp not in ('1','2') 
and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and no_kas_bud='1' 
 and no_sp2d not in (select no_sp2d from trhtransout where kd_skpd='$skpd' 
 and jns_spp not in ('1','2'))

UNION ALL

select 'trans' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhtransout a join trdtransout b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd 
where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' 
-- and a.no_sp2d='$nosp2d'
and b.kd_rek6='$rek' and a.no_bukti not in('') and b.sumber='$sumber' 


) as gabung";
        } else {
            $csql = "SELECT sum(nilai) [total] from (


select 'tagih' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] from trhtagih a 
join trdtagih b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd
join trdspp c on a.kd_skpd=c.kd_skpd and b.kd_sub_kegiatan=c.kd_sub_kegiatan and b.kd_rek6=c.kd_rek6
join trhsp2d d on c.no_spp=d.no_spp and c.kd_skpd=d.kd_skpd where
 b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' 
and b.kd_rek='$rek' and b.no_bukti not in (select no_tagih from trhspp where 
kd_skpd='$skpd' and no_spp='$nospp') and b.sumber='$sumber' and d.no_sp2d='$nosp2d' 

union all 

 select 'spp' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' 
and jns_spp not in ('1','2') and b.sumber='$sumber' and a.no_spp='$nospp' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
AND a.no_spp not in (select no_spp from trhsp2d where kd_skpd='$skpd' and jns_spp not in ('1','2') and no_sp2d='$nosp2d')  

union all 

 select 'sp2d terbit' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' and no_sp2d='$nosp2d'
and a.jns_spp not in ('1','2') and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and (no_kas_bud='' OR no_kas_bud is null)

UNION ALL

 select 'sp2d cair not trx cms' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' and no_sp2d='$nosp2d'
and a.jns_spp not in ('1','2') and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and no_kas_bud='1' and no_sp2d not in (select no_sp2d from trhtransout_cmsbank where kd_skpd='$skpd' and no_sp2d='$nosp2d' and jns_spp not in ('1','2') and
(status_validasi='0' OR status_validasi is null)
)


UNION ALL

select 'sp2d cair not trx' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhspp a join trdspp b on a.no_spp=b.no_spp and a.kd_skpd=b.kd_skpd 
inner join trhsp2d c on a.no_spp=c.no_spp and a.kd_skpd=c.kd_skpd where 
b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and b.kd_rek6='$rek' and no_sp2d='$nosp2d'
and a.jns_spp not in ('1','2') and b.sumber='$sumber' AND (a.sp2d_batal<>1 OR a.sp2d_batal IS NULL)
and no_kas_bud='1' and no_sp2d not in (select no_sp2d from trhtransout where kd_skpd='$skpd' and no_sp2d='$nosp2d' and jns_spp not in ('1','2'))

UNION ALL

select 'trans cms' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhtransout_cmsbank a join trdtransout_cmsbank b on a.no_voucher=b.no_voucher and a.kd_skpd=b.kd_skpd 
where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and a.no_sp2d='$nosp2d'
and b.kd_rek6='$rek' and a.no_voucher not in('') and b.sumber='$sumber' and (status_validasi='0' OR status_validasi is null)

UNION ALL

select 'trans' [jdl],isnull(sum(isnull(b.nilai,0)),0) [nilai] 
from trhtransout a join trdtransout b on a.no_bukti=b.no_bukti and a.kd_skpd=b.kd_skpd 
where b.kd_skpd='$skpd' and b.kd_sub_kegiatan='$giat' and a.no_sp2d='$nosp2d'
and b.kd_rek6='$rek' and a.no_bukti not in('') and b.sumber='$sumber' 


) as gabung ";
        }
        $hasil = $this->db->query($csql);
        return $hasil;
    }
}
