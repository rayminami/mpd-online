<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_registrasi_payment.php");
include_once(RelativePath . "/Common.php");
	
include "../include/fpdf17/mc_table.php";

$param_arr = CCGetFromGet("codeline");
$t_customer_order_id = CCGetFromGet("t_customer_order_id");
if(empty($t_customer_order_id)) exit;

$data = array();
$dbConn				= new clsDBConnSIKP();
$query				= "SELECT a.t_vat_setllement_id, b.p_cg_terminal_id, upper(d.vat_code) as jenis_pajak, to_char(b.payment_date,'dd/mm/yyyy') as tgl_transaksi, 
to_char(b.payment_date,'HH24:MI:SS') as jam_transaksi, b.receipt_no, a.payment_key, a.npwd, a.no_kohir,
e.wp_name, (e.wp_address_name || '/' || e.wp_address_no) AS alamat_wp,
b.payment_vat_amount as total_pokok, a.total_penalty_amount as total_denda, b.payment_vat_amount + nvl(A .total_penalty_amount,0) as total_tagihan,
upper(trim(replace(f_terbilang(to_char(round(b.payment_vat_amount + nvl(A .total_penalty_amount,0))),'rp.'), '  ', ' '))) || ' RUPIAH' as dengan_huruf,
'4'||(d.code || c.code) AS kode_rekening, upper(c.vat_code) as nama_rekening,
to_char(a.start_period,'yyyymmdd') as start_period, to_char(a.end_period,'yyyymmdd') as end_period,
company_brand,brand_address_name,brand_address_no
FROM t_vat_setllement AS a
LEFT JOIN t_payment_receipt AS b ON a.t_vat_setllement_id = b.t_vat_setllement_id
LEFT JOIN p_vat_type_dtl AS c ON a.p_vat_type_dtl_id = c.p_vat_type_dtl_id
LEFT JOIN p_vat_type AS d ON c.p_vat_type_id = d.p_vat_type_id
LEFT JOIN t_cust_account AS e ON a.t_cust_account_id = e.t_cust_account_id
WHERE a.t_customer_order_id = $t_customer_order_id";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["t_vat_setllement_id"]	= $dbConn->f("t_vat_setllement_id");
	$data["p_cg_terminal_id"]		= $dbConn->f("p_cg_terminal_id");
	$data["jenis_pajak"]		    = $dbConn->f("jenis_pajak");
	$data["tgl_transaksi"]		    = $dbConn->f("tgl_transaksi");
	$data["jam_transaksi"]		    = $dbConn->f("jam_transaksi");
	$data["receipt_no"]		        = $dbConn->f("receipt_no");
	$data["payment_key"]		    = $dbConn->f("payment_key");
	$data["npwd"]		            = $dbConn->f("npwd");
	$data["wp_name"]		        = $dbConn->f("wp_name");
	$data["alamat_wp"]		        = $dbConn->f("alamat_wp");
	$data["total_pokok"]		    = $dbConn->f("total_pokok");
	$data["total_denda"]		    = $dbConn->f("total_denda");
	$data["total_tagihan"]		    = $dbConn->f("total_tagihan");
	$data["dengan_huruf"]		    = $dbConn->f("dengan_huruf");
	$data["kode_rekening"]		    = $dbConn->f("kode_rekening");
	$data["nama_rekening"]		    = $dbConn->f("nama_rekening");
	$data["start_period"]		    = $dbConn->f("start_period");
	$data["end_period"]		        = $dbConn->f("end_period");
	$data["no_kohir"]		        = $dbConn->f("no_kohir");
	$data["company_brand"]		        = $dbConn->f("company_brand");
	$data["brand_address_name"]		        = $dbConn->f("brand_address_name");
	$data["brand_address_no"]		        = $dbConn->f("brand_address_no");
	
}
$_HEIGHT = 4;
$_BORDER = 0;
$_FONT = 'Times';
$_FONTSIZE = 10;
$pdf = new PDF_MC_Table();
$size = $pdf->_getpagesize('Legal');
$size[1]=6;
$pdf->DefPageSize = $size;
$pdf->CurPageSize = $size;
$pdf->AddPage('P',array(210,296));
//$pdf->AddPage('P',array(210,296));

$pdf->SetFont('helvetica', '', $_FONTSIZE);
$pdf->SetRightMargin($_HEIGHT);
$pdf->SetLeftMargin($_HEIGHT);

$pdf->SetAutoPageBreak(false,0);

$pdf->SetFont('Arial', '',9);

//$pdf->Image('../images/logo_pemda.png',10,5,20,20);
$pdf->ln(10);
$pdf->SetWidths(array(5,130, 60));
$pdf->SetAligns(array("L","L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"USER ID : ".$data["p_cg_terminal_id"],
				"TGL CETAK : ".date('d/m/Y')
			),
			array
			(
			    "",
				"",
				""
			),
			$_HEIGHT);
			
$pdf->SetWidths(array(5,130, 60));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"DISYANJAK",
				"JAM CETAK : ".date('H:i:s')
			),
			array
			(
			    "",
				"",
				""
			),
			$_HEIGHT);
			
$pdf->ln();
$pdf->SetWidths(array(5,130, 60));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"BUKTI PEMBAYARAN / SETORAN ".$data['jenis_pajak'],
				" "
			),
			array
			(
			    "",
				"",
				""
			),
			3);
$pdf->SetWidths(array(5,130, 60));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"PEMERINTAH KOTA BANDUNG",
				" "
			),
			array
			(
			    "",
				"",
				""
			),
			3);

$pdf->SetWidths(array(5,190));
$pdf->SetAligns(array("L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",
				
			),
			array
			(
			    "",
				""
			),
			3);


$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TANGGAL TRANSAKSI", ": ".$data['tgl_transaksi']." (DD/MM/YYYY)",
				"JAM TRANSAKSI  : ".$data['jam_transaksi']
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);


/*$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"NTP", ": ".$data['receipt_no'],
				"NOMOR KOHIR    : ".$data['no_kohir']
				
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);*/

$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
$pdf->Cell(45, $_HEIGHT, "NTP", "", 0, "");
$pdf->Cell(75, $_HEIGHT, ": ".$data['receipt_no'], "", 0, "");

$pdf->Cell(29, $_HEIGHT, "NOMOR KOHIR    :", "", 0, "");
$pdf->SetFont('Arial', '',11);
$pdf->Cell(41, $_HEIGHT, $data['no_kohir'], "", 0, "");
$pdf->ln();


$pdf->SetFont('Arial', '',9);
/*$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"NPWPD/NOPD", ": ".$data['npwd'],
				"NOMOR BAYAR   : ".$data['payment_key']
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);*/

$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
$pdf->Cell(45, $_HEIGHT, "NPWPD/NOPD", "", 0, "");
$pdf->Cell(75, $_HEIGHT, ": ".$data['npwd'], "", 0, "");

$pdf->Cell(29, $_HEIGHT, "NOMOR BAYAR   :", "", 0, "");
$pdf->SetFont('Arial', '',11);
$pdf->Cell(41, $_HEIGHT, $data['payment_key'], "", 0, "");


$pdf->ln();
$pdf->SetFont('Arial', '',9);
$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"NAMA WP/OP", ": ".$data['wp_name'],
				""
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);
$pdf->SetFont('Arial', '',9);
$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"NAMA MERK DAGANG", ": ".$data['company_brand'],
				""
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);
			
$pdf->SetWidths(array(5,45, 145));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"ALAMAT MERK DAGANG", ": ".$data['brand_address_name']." ".$data['brand_address_no']
			),
			array
			(
			    "",
				"",""
			),
			$_HEIGHT);

$pdf->ln();
$pdf->SetWidths(array(5,45, 15, 60, 70));
$pdf->SetAligns(array("L", "L", "L", "R", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TAGIHAN POKOK",": RP.", number_format($data['total_pokok'], 0, ",", "."),
				""
			),
			array
			(
			    "",
				"","",
				"",""
			),
			$_HEIGHT);
$pdf->SetWidths(array(5,45, 15, 60, 70));
$pdf->SetAligns(array("L", "L", "L", "R", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TAGIHAN DENDA",": RP.", number_format($data['total_denda'], 0, ",", "."),
				""
			),
			array
			(
			    "",
				"","",
				"",""
			),
			$_HEIGHT);


$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"", "---------------------------------------------------------------------",
				""
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);


$pdf->SetWidths(array(5,45, 15, 60, 70));
$pdf->SetAligns(array("L", "L", "L", "R", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TOTAL TAGIHAN",": RP.", number_format($data['total_tagihan'], 0, ",", "."),
				""
			),
			array
			(
			    "",
				"","",
				"",""
			),
			$_HEIGHT);	
$pdf->SetWidths(array(5,45, 15, 60, 70));
$pdf->SetAligns(array("L", "L", "L", "R", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"BIAYA ADMIN BANK",": RP.", "0",
				""
			),
			array
			(
			    "",
				"","",
				"",""
			),
			$_HEIGHT);																		
$pdf->SetWidths(array(5,45, 75, 70));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"", "---------------------------------------------------------------------",
				""
			),
			array
			(
			    "",
				"","",
				""
			),
			$_HEIGHT);
			
/*$pdf->SetWidths(array(5,45, 15, 60, 70));
$pdf->SetAligns(array("L", "L", "L", "R", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TOTAL BAYAR",": RP.", number_format($data['total_tagihan'], 0, ",", "."),
				""
			),
			array
			(
			    "",
				"","",
				"",""
			),
			$_HEIGHT);	*/
$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
$pdf->Cell(45, $_HEIGHT, "TOTAL BAYAR", "", 0, "");
$pdf->Cell(15, $_HEIGHT, ": RP.", "", 0, "");
$pdf->SetFont('Arial', '',11);
$pdf->Cell(60, $_HEIGHT, number_format($data['total_tagihan'], 0, ",", "."), "", 0, "R");
$pdf->SetFont('Arial', '',9);
$pdf->Cell(70, $_HEIGHT, "", "", 0, "");
$pdf->ln();

$pdf->SetWidths(array(5,45, 145));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"TERBILANG", ": ".$data['dengan_huruf']
			),
			array
			(
			    "",
				"",""
			),
			$_HEIGHT);

$pdf->ln();
$pdf->SetWidths(array(5,45, 145));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"KODE/NAMA REKENING", ": ".$data['kode_rekening']." / ".$data['nama_rekening']
			),
			array
			(
			    "",
				"",""
			),
			$_HEIGHT);

/*$pdf->SetWidths(array(5,45, 145));
$pdf->SetAligns(array("L", "L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"MASA AWAL/AKHIR PJK", ": ".$data['start_period']." / ".$data['end_period']
			),
			array
			(
			    "",
				"",""
			),
			$_HEIGHT);*/

$pdf->Cell(5, $_HEIGHT, "", "", 0, "");
$pdf->Cell(45, $_HEIGHT, "MASA AWAL/AKHIR PJK", "", 0, "");
$pdf->SetFont('Arial', '',11);
$pdf->Cell(145, $_HEIGHT, ": ".$data['start_period']." / ".$data['end_period'], "", 0, "");
$pdf->SetFont('Arial', '',9);
$pdf->ln();

$pdf->SetWidths(array(5,190));
$pdf->SetAligns(array("L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",
				
			),
			array
			(
			    "",
				""
			),
			3);

$pdf->SetWidths(array(5,190));
$pdf->SetAligns(array("L", "C"));
$pdf->RowMultiBorderWithHeight(
			array
			(	
			    "",
				"*BUKTI PEMBAYARAN/SETORAN INI HARAP DISIMPAN SEBAGAI BUKTI PEMBAYARAN YANG SAH*",
				
			),
			array
			(
			    "",
				""
			),
			3);						
$pdf->Output("","I");
exit;
?>