<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-34EA230E
function BindEvents()
{
    global $p_year_periodGrid;
    global $CCSEvents;
    $p_year_periodGrid->CCSEvents["BeforeShowRow"] = "p_year_periodGrid_BeforeShowRow";
    $p_year_periodGrid->CCSEvents["BeforeShow"] = "p_year_periodGrid_BeforeShow";
    $p_year_periodGrid->CCSEvents["BeforeSelect"] = "p_year_periodGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//p_year_periodGrid_BeforeShowRow @2-8F6A790D
function p_year_periodGrid_BeforeShowRow(& $sender)
{
    $p_year_periodGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_year_periodGrid; //Compatibility
//End p_year_periodGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	global $p_year_periodForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_year_period_id->GetValue();
        $p_year_periodForm->DataSource->Parameters["urlp_year_period_id"] = $selected_id;
        $p_year_periodForm->DataSource->Prepare();
        $p_year_periodForm->EditMode = $p_year_periodForm->DataSource->AllParametersSet;
        
   }
      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_year_period_id->GetValue()== $selected_id) {
      	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
          $Style = $styles[1];
          $is_show_form=1;
      }	
  // End Bdr   
      if (count($styles)) {
   //       $Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	$Component->DLink->SetValue($img_radio);
//Close p_year_periodGrid_BeforeShowRow @2-4BF2144D
    return $p_year_periodGrid_BeforeShowRow;
}
//End Close p_year_periodGrid_BeforeShowRow

//p_year_periodGrid_BeforeShow @2-4D7F6283
function p_year_periodGrid_BeforeShow(& $sender)
{
    $p_year_periodGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_year_periodGrid; //Compatibility
//End p_year_periodGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      
  // -------------------------


//Close p_year_periodGrid_BeforeShow @2-EBEC32A6
    return $p_year_periodGrid_BeforeShow;
}
//End Close p_year_periodGrid_BeforeShow

//p_year_periodGrid_BeforeSelect @2-99BF6B25
function p_year_periodGrid_BeforeSelect(& $sender)
{
    $p_year_periodGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_year_periodGrid; //Compatibility
//End p_year_periodGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close p_year_periodGrid_BeforeSelect @2-9F5E9A0B
    return $p_year_periodGrid_BeforeSelect;
}
//End Close p_year_periodGrid_BeforeSelect

//Page_OnInitializeView @1-A94DDA86
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_year_period_target_triwulan; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
    global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_year_period_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-AF413F39
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_year_period_target_triwulan; //Compatibility
//End Page_BeforeShow
	
//Custom Code @122-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$generate_status = CCGetFromGet("generate_status","");
	$year_code = CCGetFromGet("year_code","");

	if(!empty($generate_status)) {
	
		$dbConn = new clsDBConnSIKP();
		$sql ="select * from p_gen_period(".$year_code.") as msg";
		$dbConn->query($sql);
		$dbConn->next_record();
		$msg = $dbConn->f("msg");	
		$dbConn->close();
		
		if(empty($msg)) {
			echo "<script> 
			alert('OK');
			window.opener.location.reload();
			window.close();
			</script>";
		
		}else {
			echo "<script> 
			alert('".$msg."');
			window.opener.location.reload();
			window.close();
			</script>";
		}
	}

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
