<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-6EC759A8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_posisi_surat_teguran; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-351FFB50
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_posisi_surat_teguran; //Compatibility
//End Page_BeforeShow
	global $Label1;
	global $t_rep_sisa_piutangSearch;
//Custom Code @566-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = CCGetFromGet('doAction');
	if($doAction == 'view_html') {
				
		$data = array();
		
		$param_arr = array();
				
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

		$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
		$param_arr['pajak_periode'] = CCGetFromGet('pajak_periode');
		$param_arr['jenis_pajak'] = CCGetFromGet('jenis_pajak');
		$param_arr['status'] = CCGetFromGet('status',1);

		$t_rep_sisa_piutangSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
		$t_rep_sisa_piutangSearch->p_finance_period_id->SetValue($param_arr['p_finance_period_id']);
		$t_rep_sisa_piutangSearch->p_vat_type_id->SetValue($param_arr['p_vat_type_id']);
			
		$t_rep_sisa_piutangSearch->year_code->SetValue($param_arr['tahun_periode']);
		$t_rep_sisa_piutangSearch->code->SetValue($param_arr['pajak_periode']);
		$t_rep_sisa_piutangSearch->vat_code->SetValue($param_arr['jenis_pajak']);

		if(!empty($param_arr['p_finance_period_id']) and !empty($param_arr['p_vat_type_id'])) {
			$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
			$dbConn	= new clsDBConnSIKP();
			$query="select b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.* 
				from f_posisi_surat_teguran_test_2(".$param_arr['p_vat_type_id'].",".$param_arr['p_finance_period_id'].",'".$tanggal."') a
				left join t_cust_account b on a.npwpd = b.npwd
				ORDER BY company_brand,npwpd, surat_teguran_3,surat_teguran_2,surat_teguran_1";
			//echo $query;exit;
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data[] = $dbConn->Record;
			}
			$dbConn->close();

			$Label1->SetText(GetCetakHTML($data,$param_arr));

		}else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	}
	elseif($doAction == 'download_excel') {
		
		$data = array();
		
		$param_arr = array();
				
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

		$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
		$param_arr['pajak_periode'] = CCGetFromGet('pajak_periode');
		$param_arr['jenis_pajak'] = CCGetFromGet('jenis_pajak');
		$param_arr['status'] = CCGetFromGet('status',1);

		$t_rep_sisa_piutangSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
		$t_rep_sisa_piutangSearch->p_finance_period_id->SetValue($param_arr['p_finance_period_id']);
		$t_rep_sisa_piutangSearch->p_vat_type_id->SetValue($param_arr['p_vat_type_id']);
			
		$t_rep_sisa_piutangSearch->year_code->SetValue($param_arr['tahun_periode']);
		$t_rep_sisa_piutangSearch->code->SetValue($param_arr['pajak_periode']);
		$t_rep_sisa_piutangSearch->vat_code->SetValue($param_arr['jenis_pajak']);

		if(!empty($param_arr['p_finance_period_id']) and !empty($param_arr['p_vat_type_id'])) {
		$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
			$dbConn	= new clsDBConnSIKP();
			$query="select b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.* 
				from f_posisi_surat_teguran_test_2(".$param_arr['p_vat_type_id'].",".$param_arr['p_finance_period_id'].",'".$tanggal."') a
				left join t_cust_account b on a.npwpd = b.npwd
				ORDER BY company_brand,npwpd, surat_teguran_3,surat_teguran_2,surat_teguran_1";
			//echo $query;exit;
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data[] = $dbConn->Record;
			}
			$dbConn->close();

			CetakExcel($data, $param_arr);

		 }else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	}
	
//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($data,$param_arr) {
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN POSISI SURAT TEGURAN</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .= '<h2>JENIS PAJAK : '.$param_arr['jenis_pajak'].' </h2>';
	$output .= '<h2>PERIODE PAJAK : '.$param_arr['pajak_periode'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr >';


		$output.='<th align="center" >NO</th>';
		$output.='<th align="center" >MERK DAGANG</th>';
		$output.='<th align="center" >ALAMAT MERK DAGANG</th>';
		$output.='<th align="center" >NPWPD</th>';
		$output.='<th align="center" >SURAT TEGURAN 1</th>';
		$output.='<th align="center" >SURAT TEGURAN 2</th>';
		$output.='<th align="center" >SURAT TEGURAN 3</th>';
		$output.='<th align="center" >PER TANGGAL '.$tanggal.'</th>';
		$output.='<th align="center" >SETELAH TANGGAL '.$tanggal.'</th>';
		$output.='</tr>';
    	
		$temp = $data[0];
		$debt_amount =0;
		
		$pf = CCGetFromGet('p_finance_period_id');
		$dbConn	= new clsDBConnSIKP();
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",1);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_1_desc="Tidak Terbit";
		}else{
			$surat_teguran_1_desc="Belum Terbit";
		}
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",2);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_2_desc="Tidak Terbit";
		}else{
			$surat_teguran_2_desc="Belum Terbit";
		}
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",3);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_3_desc="Tidak Terbit";
		}else{
			$surat_teguran_3_desc="Belum Terbit";
		}


		$dbConn->close();

		$surat_teguran_1 =$surat_teguran_1_desc;
		$surat_teguran_2 =$surat_teguran_2_desc;
		$surat_teguran_3 =$surat_teguran_3_desc;
		if ($temp['surat_teguran_1']=='1'){
			$surat_teguran_1 = 'Terbit('.$temp['tgl_teg_1'].')';
		}
		if ($temp['surat_teguran_2']=='1'){
			$surat_teguran_2 = 'Terbit('.$temp['tgl_teg_2'].')';
		}
		if ($temp['surat_teguran_3']=='1'){
			$surat_teguran_3 = 'Terbit('.$temp['tgl_teg_3'].')';
		}
		$j=0;
		$sebelum = 'Belum Bayar';
		$sesudah = 'Belum Bayar';
		for ($i = 1; $i < count($data); $i++) {
			if($temp['npwpd']==$data[$i]['npwpd']){
				if ($data[$i]['surat_teguran_1']=='1'){
					$surat_teguran_1 = 'Terbit ('.$data[$i]['tgl_teg_1'].')';
					$debt_amount =0;
				}
				if ($data[$i]['surat_teguran_2']=='1'){
					$surat_teguran_2 = 'Terbit ('.$data[$i]['tgl_teg_2'].')';
					$debt_amount =0;
				}
				if ($data[$i]['surat_teguran_3']=='1'){
					$debt_amount =$data[$i]['debt_amount'];
					$surat_teguran_3 = 'Terbit ('.$data[$i]['tgl_teg_3'].') (Rp. '.number_format($debt_amount, 2, ',', '.').')';
					$debt_amount =0;
				}
			}else{
				$output .= '<tr>';
				$output .= '<td align="center">'.($j+1).'</td>';
				$output .= '<td align="left">'.$temp['company_brand'].'</td>';
				$output .= '<td align="left">'.$temp['alamat_merk_dagang'].'</td>';
				$output .= '<td align="center">'.$temp['npwpd'].'</td>';
				$output .= '<td align="center">'.$surat_teguran_1.'</td>';
				$output .= '<td align="center">'.$surat_teguran_2.'</td>';
				$output .= '<td align="center">'.$surat_teguran_3.'</td>'; 
				$output .= '<td align="center">'.$data[$i-1]['tgl_bayar'].'</td>'; 
				$output .= '<td align="center">'.$data[$i-1]['tgl_bayar2'].'</td>'; 
				$output .= '</tr>';
				$temp = $data[$i];
				$surat_teguran_1 =$surat_teguran_1_desc;
				$surat_teguran_2 =$surat_teguran_2_desc;
				$surat_teguran_3 =$surat_teguran_3_desc;
				if ($temp['surat_teguran_1']=='1'){
					$surat_teguran_1 = 'Terbit ('.$data[$i]['tgl_teg_1'].')';
					$debt_amount =0;
				}
				if ($temp['surat_teguran_2']=='1'){
					$surat_teguran_2 = 'Terbit ('.$data[$i]['tgl_teg_2'].')';
					$debt_amount =0;
				}
				if ($temp['surat_teguran_3']=='1'){
					$debt_amount =$data[$i]['debt_amount'];
					$surat_teguran_3 = 'Terbit ('.$data[$i]['tgl_teg_3'].') (Rp. '.number_format($debt_amount, 2, ',', '.').')';	
					$debt_amount =0;				
				}
				$j=$j+1;
			}
		}
		if ($j > 0){
			$output .= '<tr>';
			$output .= '<td align="center">'.($j+1).'</td>';
			$output .= '<td align="left">'.$temp['company_brand'].'</td>';
			$output .= '<td align="left">'.$temp['alamat_merk_dagang'].'</td>';
			$output .= '<td align="center">'.$temp['npwpd'].'</td>';
			$output .= '<td align="center">'.$surat_teguran_1.'</td>';
			$output .= '<td align="center">'.$surat_teguran_2.'</td>';
			$output .= '<td align="center">'.$surat_teguran_3.'</td>'; 
			$output .= '<td align="center">'.$data[$i-1]['tgl_bayar'].'</td>'; 
			$output .= '<td align="center">'.$data[$i-1]['tgl_bayar2'].'</td>'; 
			$output .= '</tr>';
		}
		$output.='</table>';
	
	return $output;
}

function CetakExcel($data, $param_arr) {
	
	startExcel("laporan_posisi_status_teguran");
	
	$output = '';

	$output .= '<h2>LAPORAN POSISI SURAT TEGURAN<h2/>';



	$output .= '<h3>JENIS PAJAK : '.$param_arr['jenis_pajak'].'<br/>';
	$output .= 'PERIODE PAJAK : '.$param_arr['pajak_periode'].'<br/>';
	//$output .= 'JATUH TEMPO : '.strtoupper(dateToString($tgl_jatuh_tempo)).'</h3>';

	$output .='<table border="1" widht="100%">
                <tr>';
		$output.='<th align="center" >NO</th>';
		$output.='<th align="center" >MERK DAGANG</th>';
		$output.='<th align="center" >ALAMAT MERK DAGANG</th>';
		$output.='<th align="center" >NPWPD</th>';
		$output.='<th align="center" >SURAT TEGURAN 1</th>';
		$output.='<th align="center" >SURAT TEGURAN 2</th>';
		$output.='<th align="center" >SURAT TEGURAN 3</th>';
		$output.='<th align="center" >PER TANGGAL '.$tanggal.'</th>';
		$output.='<th align="center" >SETELAH TANGGAL '.$tanggal.'</th>';
		$output.='</tr>';
    	
		$temp = $data[0];
		$debt_amount =0;
		
		$pf = CCGetFromGet('p_finance_period_id');
		$dbConn	= new clsDBConnSIKP();
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",1);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_1_desc="Tidak Terbit";
		}else{
			$surat_teguran_1_desc="Belum Terbit";
		}
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",2);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_2_desc="Tidak Terbit";
		}else{
			$surat_teguran_2_desc="Belum Terbit";
		}
		$query="select f_cek_penerbitan_surat_teguran from 
		f_cek_penerbitan_surat_teguran(".$pf.",3);";
		$dbConn->query($query);
		$dbConn->next_record();
		$result=$dbConn->f('f_cek_penerbitan_surat_teguran');
		if ($result==1){
			$surat_teguran_3_desc="Tidak Terbit";
		}else{
			$surat_teguran_3_desc="Belum Terbit";
		}


		$dbConn->close();

		$surat_teguran_1 =$surat_teguran_1_desc;
		$surat_teguran_2 =$surat_teguran_2_desc;
		$surat_teguran_3 =$surat_teguran_3_desc;
		if ($temp['surat_teguran_1']=='1'){
			$surat_teguran_1 = 'Terbit('.$temp['tgl_teg_1'].')';
		}
		if ($temp['surat_teguran_2']=='1'){
			$surat_teguran_2 = 'Terbit('.$temp['tgl_teg_2'].')';
		}
		if ($temp['surat_teguran_3']=='1'){
			$surat_teguran_3 = 'Terbit('.$temp['tgl_teg_3'].')';
		}
		$j=0;
		$sebelum = 'Belum Bayar';
		$sesudah = 'Belum Bayar';
		for ($i = 1; $i < count($data); $i++) {
			if($temp['npwpd']==$data[$i]['npwpd']){
				if ($data[$i]['surat_teguran_1']=='1'){
					$surat_teguran_1 = 'Terbit ('.$data[$i]['tgl_teg_1'].')';
					$debt_amount =0;
				}
				if ($data[$i]['surat_teguran_2']=='1'){
					$surat_teguran_2 = 'Terbit ('.$data[$i]['tgl_teg_2'].')';
					$debt_amount =0;
				}
				if ($data[$i]['surat_teguran_3']=='1'){
					$debt_amount =$data[$i]['debt_amount'];
					$surat_teguran_3 = 'Terbit ('.$data[$i]['tgl_teg_3'].') (Rp. '.number_format($debt_amount, 2, ',', '.').')';
					$debt_amount =0;
				}
			}else{
				$output .= '<tr>';
				$output .= '<td align="center">'.($j+1).'</td>';
				$output .= '<td align="left">'.$temp['company_brand'].'</td>';
				$output .= '<td align="left">'.$temp['alamat_merk_dagang'].'</td>';
				$output .= '<td align="center">'.$temp['npwpd'].'</td>';
				$output .= '<td align="center">'.$surat_teguran_1.'</td>';
				$output .= '<td align="center">'.$surat_teguran_2.'</td>';
				$output .= '<td align="center">'.$surat_teguran_3.'</td>'; 
				$output .= '<td align="center">'.$data[$i-1]['tgl_bayar'].'</td>'; 
				$output .= '<td align="center">'.$data[$i-1]['tgl_bayar2'].'</td>'; 
				$output .= '</tr>';
				$temp = $data[$i];
				$surat_teguran_1 =$surat_teguran_1_desc;
				$surat_teguran_2 =$surat_teguran_2_desc;
				$surat_teguran_3 =$surat_teguran_3_desc;
				if ($temp['surat_teguran_1']=='1'){
					$surat_teguran_1 = 'Terbit ('.$data[$i]['tgl_teg_1'].')';
					$debt_amount =0;
				}
				if ($temp['surat_teguran_2']=='1'){
					$surat_teguran_2 = 'Terbit ('.$data[$i]['tgl_teg_2'].')';
					$debt_amount =0;
				}
				if ($temp['surat_teguran_3']=='1'){
					$debt_amount =$data[$i]['debt_amount'];
					$surat_teguran_3 = 'Terbit ('.$data[$i]['tgl_teg_3'].') (Rp. '.number_format($debt_amount, 2, ',', '.').')';	
					$debt_amount =0;				
				}
				$j=$j+1;
			}
		}
		if ($j > 0){
			$output .= '<tr>';
			$output .= '<td align="center">'.($j+1).'</td>';
			$output .= '<td align="left">'.$temp['company_brand'].'</td>';
			$output .= '<td align="left">'.$temp['alamat_merk_dagang'].'</td>';
			$output .= '<td align="center">'.$temp['npwpd'].'</td>';
			$output .= '<td align="center">'.$surat_teguran_1.'</td>';
			$output .= '<td align="center">'.$surat_teguran_2.'</td>';
			$output .= '<td align="center">'.$surat_teguran_3.'</td>'; 
			$output .= '<td align="center">'.$data[$i-1]['tgl_bayar'].'</td>'; 
			$output .= '<td align="center">'.$data[$i-1]['tgl_bayar2'].'</td>'; 
			$output .= '</tr>';
		}
		$output.='</table>';

	echo $output;
	exit;
}

function dateToString($date){
	if(empty($date)) return "";
	
	$monthname = array(0  => '-',
	                   1  => 'Januari',
	                   2  => 'Februari',
	                   3  => 'Maret',
	                   4  => 'April',
	                   5  => 'Mei',
	                   6  => 'Juni',
	                   7  => 'Juli',
	                   8  => 'Agustus',
	                   9  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode('-', $date);
	
	return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}


function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

?>
