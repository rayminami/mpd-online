<?php
//Include Common Files @1-714ACAC2
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_restore_trans.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordp_room_typeSearch { //p_room_typeSearch Class @3-1AC24589

//Variables @3-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @3-234FD3FA
    function clsRecordp_room_typeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_room_typeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_room_typeSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->date_end_laporan = & new clsControl(ccsTextBox, "date_end_laporan", "date_end_laporan", ccsText, "", CCGetRequestParam("date_end_laporan", $Method, NULL), $this);
            $this->DatePicker_end_start_laporan1 = & new clsDatePicker("DatePicker_end_start_laporan1", "p_room_typeSearch", "date_end_laporan", $this);
            $this->date_start_laporan = & new clsControl(ccsTextBox, "date_start_laporan", "date_start_laporan", ccsText, "", CCGetRequestParam("date_start_laporan", $Method, NULL), $this);
            $this->DatePicker_end_start_laporan2 = & new clsDatePicker("DatePicker_end_start_laporan2", "p_room_typeSearch", "date_start_laporan", $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-BAE691FB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->date_end_laporan->Validate() && $Validation);
        $Validation = ($this->date_start_laporan->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_end_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_start_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-395D9221
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->date_end_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_start_laporan1->Errors->Count());
        $errors = ($errors || $this->date_start_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_start_laporan2->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @3-94BB52A7
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "t_restore_trans.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_restore_trans.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-5F9E219B
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_end_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_start_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_start_laporan2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $this->vat_code->Show();
        $this->date_end_laporan->Show();
        $this->DatePicker_end_start_laporan1->Show();
        $this->date_start_laporan->Show();
        $this->DatePicker_end_start_laporan2->Show();
        $this->p_vat_type_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_room_typeSearch Class @3-FCB6E20C



class clsGridp_room_typeGrid { //p_room_typeGrid class @2-BD72B7F0

//Variables @2-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @2-27FC397F
    function clsGridp_room_typeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_room_typeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_room_typeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_room_typeGridDataSource($this);
        $this->ds = & $this->DataSource;

        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_restore_trans.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->periode_code = & new clsControl(ccsLabel, "periode_code", "periode_code", ccsText, "", CCGetRequestParam("periode_code", ccsGet, NULL), $this);
        $this->settlement_date = & new clsControl(ccsLabel, "settlement_date", "settlement_date", ccsText, "", CCGetRequestParam("settlement_date", ccsGet, NULL), $this);
        $this->settlement_type = & new clsControl(ccsLabel, "settlement_type", "settlement_type", ccsText, "", CCGetRequestParam("settlement_type", ccsGet, NULL), $this);
        $this->modification_type = & new clsControl(ccsLabel, "modification_type", "modification_type", ccsText, "", CCGetRequestParam("modification_type", ccsGet, NULL), $this);
        $this->alasan = & new clsControl(ccsLabel, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", ccsGet, NULL), $this);
        $this->modified_by = & new clsControl(ccsLabel, "modified_by", "modified_by", ccsText, "", CCGetRequestParam("modified_by", ccsGet, NULL), $this);
        $this->modification_date = & new clsControl(ccsLabel, "modification_date", "modification_date", ccsText, "", CCGetRequestParam("modification_date", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-243B0B8C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlp_vat_type_id"] = CCGetFromGet("p_vat_type_id", NULL);
        $this->DataSource->Parameters["urldate_start_laporan"] = CCGetFromGet("date_start_laporan", NULL);
        $this->DataSource->Parameters["urldate_end_laporan"] = CCGetFromGet("date_end_laporan", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["periode_code"] = $this->periode_code->Visible;
            $this->ControlsVisible["settlement_date"] = $this->settlement_date->Visible;
            $this->ControlsVisible["settlement_type"] = $this->settlement_type->Visible;
            $this->ControlsVisible["modification_type"] = $this->modification_type->Visible;
            $this->ControlsVisible["alasan"] = $this->alasan->Visible;
            $this->ControlsVisible["modified_by"] = $this->modified_by->Visible;
            $this->ControlsVisible["modification_date"] = $this->modification_date->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_room_type_id", $this->DataSource->f("p_room_type_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->periode_code->SetValue($this->DataSource->periode_code->GetValue());
                $this->settlement_date->SetValue($this->DataSource->settlement_date->GetValue());
                $this->settlement_type->SetValue($this->DataSource->settlement_type->GetValue());
                $this->modification_type->SetValue($this->DataSource->modification_type->GetValue());
                $this->alasan->SetValue($this->DataSource->alasan->GetValue());
                $this->modified_by->SetValue($this->DataSource->modified_by->GetValue());
                $this->modification_date->SetValue($this->DataSource->modification_date->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->periode_code->Show();
                $this->settlement_date->Show();
                $this->settlement_type->Show();
                $this->modification_type->Show();
                $this->alasan->Show();
                $this->modified_by->Show();
                $this->modification_date->Show();
                $this->t_vat_setllement_id->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method


//GetErrors Method @2-EFDE9263
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->settlement_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->settlement_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->modification_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->alasan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->modified_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->modification_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_room_typeGrid Class @2-FCB6E20C

class clsp_room_typeGridDataSource extends clsDBConnSIKP {  //p_room_typeGridDataSource Class @2-5ECC680F

//DataSource Variables @2-587E7F75
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $periode_code;
    var $settlement_date;
    var $settlement_type;
    var $modification_type;
    var $alasan;
    var $modified_by;
    var $modification_date;
    var $t_vat_setllement_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D6486BCD
    function clsp_room_typeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_room_typeGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->periode_code = new clsField("periode_code", ccsText, "");
        
        $this->settlement_date = new clsField("settlement_date", ccsText, "");
        
        $this->settlement_type = new clsField("settlement_type", ccsText, "");
        
        $this->modification_type = new clsField("modification_type", ccsText, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        
        $this->modified_by = new clsField("modified_by", ccsText, "");
        
        $this->modification_date = new clsField("modification_date", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-6A350945
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlp_vat_type_id", ccsFloat, "", "", $this->Parameters["urlp_vat_type_id"], null, false);
        $this->wp->AddParameter("3", "urldate_start_laporan", ccsText, "", "", $this->Parameters["urldate_start_laporan"], null, false);
        $this->wp->AddParameter("4", "urldate_end_laporan", ccsText, "", "", $this->Parameters["urldate_end_laporan"], null, false);
    }
//End Prepare Method
 
//Open Method @2-6CE3653C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT *, p.code, t.code as type_code\n" .
        "FROM h_vat_setllement h\n" .
        "LEFT JOIN p_finance_period p \n" .
        "on p.p_finance_period_id = h.p_finance_period_id\n" .
        "LEFT JOIN p_settlement_type t \n" .
        "on t.p_settlement_type_id = h.p_settlement_type_id\n" .
        "WHERE h.npwd LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "and modification_type = 'Delete') cnt";
        $this->SQL = "SELECT *, p.code, t.code as type_code\n" .
        "FROM h_vat_setllement h\n" .
        "LEFT JOIN p_finance_period p \n" .
        "on p.p_finance_period_id = h.p_finance_period_id\n" .
        "LEFT JOIN p_settlement_type t \n" .
        "on t.p_settlement_type_id = h.p_settlement_type_id\n" .
        "WHERE h.npwd LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "and modification_type = 'Delete'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E89689DD
    function SetValues()
    {
        $this->code->SetDBValue($this->f("npwd"));
        $this->periode_code->SetDBValue($this->f("code"));
        $this->settlement_date->SetDBValue($this->f("settlement_date"));
        $this->settlement_type->SetDBValue($this->f("type_code"));
        $this->modification_type->SetDBValue($this->f("modification_type"));
        $this->alasan->SetDBValue($this->f("alasan"));
        $this->modified_by->SetDBValue($this->f("modified_by"));
        $this->modification_date->SetDBValue($this->f("modification_date"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
    }
//End SetValues Method

} //End p_room_typeGridDataSource Class @2-FCB6E20C



//Initialize Page @1-6565C759
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "t_restore_trans.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-209098FF
include_once("./t_restore_trans_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-EE212AA6
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_room_typeSearch = & new clsRecordp_room_typeSearch("", $MainPage);
$p_room_typeGrid = & new clsGridp_room_typeGrid("", $MainPage);
$MainPage->p_room_typeSearch = & $p_room_typeSearch;
$MainPage->p_room_typeGrid = & $p_room_typeGrid;
$p_room_typeGrid->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-99BA6666
$p_room_typeSearch->Operation();
//End Execute Components

//Go to destination page @1-1C8153E7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_room_typeSearch);
    unset($p_room_typeGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-434BA14E
$p_room_typeSearch->Show();
$p_room_typeGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2753106B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_room_typeSearch);
unset($p_room_typeGrid);
unset($Tpl);
//End Unload Page


?>
