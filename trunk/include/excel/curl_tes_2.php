<?php
error_reporting(E_ALL ^ E_WARNING);
define("RelativePath", "../..");
	define("PathToCurrentPage", "/include/excel/");	
	define("FileName", "curl_tes_2.php"); 	
	include_once(RelativePath . "/Common.php");

function sendSms(){
	
    include 'save_excel_2.php';

	$dbConn	= new clsDBConnSIKP();
	$query = "SELECT * FROM t_sms_outbox where is_sent = 'N'";
	$dbConn->query($query);
	$data = array();
	while ($dbConn->next_record()) {
		$data[] = array (
		    't_sms_outbox_id' => $dbConn->f("t_sms_outbox_id"), 	
			'npwpd' => $dbConn->f("npwpd"), 	
			'mobile_no' => $dbConn->f("mobile_no"), 	
			'message' => $dbConn->f("message"),
			'is_sent' => $dbConn->f("is_sent"),
			'date_sent' => $dbConn->f("date_sent"),
			'date_addded' => $dbConn->f("date_addded")
		);
	}

	if(sizeof($data)>0){
		//print_r($data);
		$file_name = createExcel($data);
		date_default_timezone_set('Asia/Jakarta');
		$send_date = date('Y-m-d-H-i-s');
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/_libz/usersignin.php");
	    curl_setopt($ch, CURLOPT_POST, 1);
	    // in real life you should use something like:
	        curl_setopt($ch, CURLOPT_POSTFIELDS, 
	                    array(  'loginUsername'  => 'disyanjak',//'radnettrial',
	                            'loginPass'    => 'disyanjakbdg12345678',//'trial',
	                            'attached_type' => 'action_1',
	                            'senderID'      => 'JMP000007',
	                            'sender'	    => 'DISYANJAK',
	                            'tanggal'	    => substr($send_date,0,10),//'2014-03-11',
	                            'jam1'	        => substr($send_date,11,2),//'16',
	                            'mnt1'	        => ''.(substr($send_date,14,2)+3).'',//'19',
	                            'pesan'	        => '',
	                            'tb_simpan'	    => 'Submit',
	                            'login_btn'     => 'Login',
	                            'nmbatch'       => '@' . realpath($file_name.'.xls') . ';filename='.$file_name.'_'.$send_date.'.xls'
	                          )
	                    );
    
	    // receive server response ...
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    
	    $tmp_fname = tempnam("/tmp", "COOKIE");
     
	    curl_setopt ($ch, CURLOPT_COOKIEJAR, $tmp_fname);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    
	    $server_output = curl_exec ($ch);
    
	    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/userarea/p/personalize_exe.php");
	    curl_setopt ($ch, CURLOPT_COOKIEFILE, $tmp_fname);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	    $server_output = curl_exec ($ch);
		echo $server_output;
	    curl_close ($ch);

		for($counter = 0;$counter < sizeof($data);$counter++){
			$query=" UPDATE t_sms_outbox
		   		SET is_sent='Y',date_sent=sysdate
		 		WHERE t_sms_outbox_id=".$data[$counter]['t_sms_outbox_id'];
			$dbConn->query($query);
		}
	}else{
		echo "no data";
	}
	
	/*
    if(!empty($_GET)){
        $npwd = $_GET['npwd'];
        $no_telp = $_GET['no_telp'];
        $message = $_GET['message'];
    }else if(!empty($_POST)){
        $npwd = $_POST['npwd'];
        $no_telp = $_POST['no_telp'];
        $message = $_POST['message'];
    }
	*/
    //$file_name = createExcel($no_telp,$npwd);
	
}
sendSms();