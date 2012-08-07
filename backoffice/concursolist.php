<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "concursoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$concurso_list = new cconcurso_list();
$Page =& $concurso_list;

// Page init
$concurso_list->Page_Init();

// Page main
$concurso_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($concurso->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_list = new ew_Page("concurso_list");

// page properties
concurso_list.PageID = "list"; // page ID
concurso_list.FormID = "fconcursolist"; // form ID
var EW_PAGE_ID = concurso_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
concurso_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($concurso->Export == "") || (EW_EXPORT_MASTER_RECORD && $concurso->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$concurso_list->TotalRecs = $concurso->SelectRecordCount();
	} else {
		if ($concurso_list->Recordset = $concurso_list->LoadRecordset())
			$concurso_list->TotalRecs = $concurso_list->Recordset->RecordCount();
	}
	$concurso_list->StartRec = 1;
	if ($concurso_list->DisplayRecs <= 0 || ($concurso->Export <> "" && $concurso->ExportAll)) // Display all records
		$concurso_list->DisplayRecs = $concurso_list->TotalRecs;
	if (!($concurso->Export <> "" && $concurso->ExportAll))
		$concurso_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$concurso_list->Recordset = $concurso_list->LoadRecordset($concurso_list->StartRec-1, $concurso_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso->TableCaption() ?>
&nbsp;&nbsp;<?php $concurso_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($concurso->Export == "" && $concurso->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(concurso_list);" style="text-decoration: none;"><img id="concurso_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="concurso_list_SearchPanel">
<form name="fconcursolistsrch" id="fconcursolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="concurso">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($concurso->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $concurso_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($concurso->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($concurso->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($concurso->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $concurso_list->ShowPageHeader(); ?>
<?php
$concurso_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fconcursolist" id="fconcursolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="concurso">
<div id="gmp_concurso" class="ewGridMiddlePanel">
<?php if ($concurso_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $concurso->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$concurso_list->RenderListOptions();

// Render list options (header, left)
$concurso_list->ListOptions->Render("header", "left");
?>
<?php if ($concurso->idConcurso->Visible) { // idConcurso ?>
	<?php if ($concurso->SortUrl($concurso->idConcurso) == "") { ?>
		<td><?php echo $concurso->idConcurso->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso->SortUrl($concurso->idConcurso) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso->idConcurso->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso->idConcurso->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso->idConcurso->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso->nombre->Visible) { // nombre ?>
	<?php if ($concurso->SortUrl($concurso->nombre) == "") { ?>
		<td><?php echo $concurso->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso->SortUrl($concurso->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($concurso->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso->fechaInicio->Visible) { // fechaInicio ?>
	<?php if ($concurso->SortUrl($concurso->fechaInicio) == "") { ?>
		<td><?php echo $concurso->fechaInicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso->SortUrl($concurso->fechaInicio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso->fechaInicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso->fechaInicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso->fechaInicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso->fechaFin->Visible) { // fechaFin ?>
	<?php if ($concurso->SortUrl($concurso->fechaFin) == "") { ?>
		<td><?php echo $concurso->fechaFin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso->SortUrl($concurso->fechaFin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso->fechaFin->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso->fechaFin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso->fechaFin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$concurso_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($concurso->ExportAll && $concurso->Export <> "") {
	$concurso_list->StopRec = $concurso_list->TotalRecs;
} else {

	// Set the last record to display
	if ($concurso_list->TotalRecs > $concurso_list->StartRec + $concurso_list->DisplayRecs - 1)
		$concurso_list->StopRec = $concurso_list->StartRec + $concurso_list->DisplayRecs - 1;
	else
		$concurso_list->StopRec = $concurso_list->TotalRecs;
}
$concurso_list->RecCnt = $concurso_list->StartRec - 1;
if ($concurso_list->Recordset && !$concurso_list->Recordset->EOF) {
	$concurso_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $concurso_list->StartRec > 1)
		$concurso_list->Recordset->Move($concurso_list->StartRec - 1);
} elseif (!$concurso->AllowAddDeleteRow && $concurso_list->StopRec == 0) {
	$concurso_list->StopRec = $concurso->GridAddRowCount;
}

// Initialize aggregate
$concurso->RowType = EW_ROWTYPE_AGGREGATEINIT;
$concurso->ResetAttrs();
$concurso_list->RenderRow();
$concurso_list->RowCnt = 0;
while ($concurso_list->RecCnt < $concurso_list->StopRec) {
	$concurso_list->RecCnt++;
	if (intval($concurso_list->RecCnt) >= intval($concurso_list->StartRec)) {
		$concurso_list->RowCnt++;

		// Set up key count
		$concurso_list->KeyCount = $concurso_list->RowIndex;

		// Init row class and style
		$concurso->ResetAttrs();
		$concurso->CssClass = "";
		if ($concurso->CurrentAction == "gridadd") {
		} else {
			$concurso_list->LoadRowValues($concurso_list->Recordset); // Load row values
		}
		$concurso->RowType = EW_ROWTYPE_VIEW; // Render view
		$concurso->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$concurso_list->RenderRow();

		// Render list options
		$concurso_list->RenderListOptions();
?>
	<tr<?php echo $concurso->RowAttributes() ?>>
<?php

// Render list options (body, left)
$concurso_list->ListOptions->Render("body", "left");
?>
	<?php if ($concurso->idConcurso->Visible) { // idConcurso ?>
		<td<?php echo $concurso->idConcurso->CellAttributes() ?>>
<div<?php echo $concurso->idConcurso->ViewAttributes() ?>><?php echo $concurso->idConcurso->ListViewValue() ?></div>
<a name="<?php echo $concurso_list->PageObjName . "_row_" . $concurso_list->RowCnt ?>" id="<?php echo $concurso_list->PageObjName . "_row_" . $concurso_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($concurso->nombre->Visible) { // nombre ?>
		<td<?php echo $concurso->nombre->CellAttributes() ?>>
<div<?php echo $concurso->nombre->ViewAttributes() ?>><?php echo $concurso->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($concurso->fechaInicio->Visible) { // fechaInicio ?>
		<td<?php echo $concurso->fechaInicio->CellAttributes() ?>>
<div<?php echo $concurso->fechaInicio->ViewAttributes() ?>><?php echo $concurso->fechaInicio->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($concurso->fechaFin->Visible) { // fechaFin ?>
		<td<?php echo $concurso->fechaFin->CellAttributes() ?>>
<div<?php echo $concurso->fechaFin->ViewAttributes() ?>><?php echo $concurso->fechaFin->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$concurso_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($concurso->CurrentAction <> "gridadd")
		$concurso_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($concurso_list->Recordset)
	$concurso_list->Recordset->Close();
?>
<?php if ($concurso->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($concurso->CurrentAction <> "gridadd" && $concurso->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($concurso_list->Pager)) $concurso_list->Pager = new cPrevNextPager($concurso_list->StartRec, $concurso_list->DisplayRecs, $concurso_list->TotalRecs) ?>
<?php if ($concurso_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($concurso_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_list->PageUrl() ?>start=<?php echo $concurso_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($concurso_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_list->PageUrl() ?>start=<?php echo $concurso_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $concurso_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($concurso_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_list->PageUrl() ?>start=<?php echo $concurso_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($concurso_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_list->PageUrl() ?>start=<?php echo $concurso_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $concurso_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $concurso_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $concurso_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $concurso_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($concurso_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $concurso_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($concurso->Export == "" && $concurso->CurrentAction == "") { ?>
<?php } ?>
<?php
$concurso_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($concurso->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$concurso_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'concurso';

	// Page object name
	var $PageObjName = 'concurso_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $concurso;
		if ($concurso->UseTokenInUrl) $PageUrl .= "t=" . $concurso->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $concurso;
		if ($concurso->UseTokenInUrl) {
			if ($objForm)
				return ($concurso->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($concurso->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconcurso_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (concurso)
		if (!isset($GLOBALS["concurso"])) {
			$GLOBALS["concurso"] = new cconcurso();
			$GLOBALS["Table"] =& $GLOBALS["concurso"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "concursoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "concursodelete.php";
		$this->MultiUpdateUrl = "concursoupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'concurso', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $concurso;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$concurso->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$concurso->Export = $_POST["exporttype"];
		} else {
			$concurso->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $concurso->Export; // Get export parameter, used in header
		$gsExportFile = $concurso->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($concurso->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($concurso->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$concurso->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $concurso;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($concurso->Export <> "" ||
				$concurso->CurrentAction == "gridadd" ||
				$concurso->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$concurso->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($concurso->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $concurso->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$concurso->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$concurso->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$concurso->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $concurso->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$concurso->setSessionWhere($sFilter);
		$concurso->CurrentFilter = "";

		// Export data only
		if (in_array($concurso->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($concurso->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $concurso;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $concurso->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $concurso->texto, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $concurso;
		$sSearchStr = "";
		$sSearchKeyword = $concurso->BasicSearchKeyword;
		$sSearchType = $concurso->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$concurso->setSessionBasicSearchKeyword($sSearchKeyword);
			$concurso->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $concurso;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$concurso->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $concurso;
		$concurso->setSessionBasicSearchKeyword("");
		$concurso->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $concurso;
		$bRestore = TRUE;
		if ($concurso->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$concurso->BasicSearchKeyword = $concurso->getSessionBasicSearchKeyword();
			$concurso->BasicSearchType = $concurso->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $concurso;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$concurso->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$concurso->CurrentOrderType = @$_GET["ordertype"];
			$concurso->UpdateSort($concurso->idConcurso); // idConcurso
			$concurso->UpdateSort($concurso->nombre); // nombre
			$concurso->UpdateSort($concurso->fechaInicio); // fechaInicio
			$concurso->UpdateSort($concurso->fechaFin); // fechaFin
			$concurso->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $concurso;
		$sOrderBy = $concurso->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($concurso->SqlOrderBy() <> "") {
				$sOrderBy = $concurso->SqlOrderBy();
				$concurso->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $concurso;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$concurso->setSessionOrderBy($sOrderBy);
				$concurso->idConcurso->setSort("");
				$concurso->nombre->setSort("");
				$concurso->fechaInicio->setSort("");
				$concurso->fechaFin->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$concurso->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $concurso;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $concurso, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $concurso;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $concurso;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$concurso->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$concurso->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $concurso->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$concurso->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$concurso->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$concurso->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $concurso;
		$concurso->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$concurso->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $concurso;

		// Call Recordset Selecting event
		$concurso->Recordset_Selecting($concurso->CurrentFilter);

		// Load List page SQL
		$sSql = $concurso->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$concurso->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $concurso;
		$sFilter = $concurso->KeyFilter();

		// Call Row Selecting event
		$concurso->Row_Selecting($sFilter);

		// Load SQL based on filter
		$concurso->CurrentFilter = $sFilter;
		$sSql = $concurso->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $concurso;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$concurso->Row_Selected($row);
		$concurso->idConcurso->setDbValue($rs->fields('idConcurso'));
		$concurso->nombre->setDbValue($rs->fields('nombre'));
		$concurso->texto->setDbValue($rs->fields('texto'));
		$concurso->fechaInicio->setDbValue($rs->fields('fechaInicio'));
		$concurso->fechaFin->setDbValue($rs->fields('fechaFin'));
	}

	// Load old record
	function LoadOldRecord() {
		global $concurso;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($concurso->getKey("idConcurso")) <> "")
			$concurso->idConcurso->CurrentValue = $concurso->getKey("idConcurso"); // idConcurso
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$concurso->CurrentFilter = $concurso->KeyFilter();
			$sSql = $concurso->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $concurso;

		// Initialize URLs
		$this->ViewUrl = $concurso->ViewUrl();
		$this->EditUrl = $concurso->EditUrl();
		$this->InlineEditUrl = $concurso->InlineEditUrl();
		$this->CopyUrl = $concurso->CopyUrl();
		$this->InlineCopyUrl = $concurso->InlineCopyUrl();
		$this->DeleteUrl = $concurso->DeleteUrl();

		// Call Row_Rendering event
		$concurso->Row_Rendering();

		// Common render codes for all row types
		// idConcurso
		// nombre
		// texto
		// fechaInicio
		// fechaFin

		if ($concurso->RowType == EW_ROWTYPE_VIEW) { // View row

			// idConcurso
			$concurso->idConcurso->ViewValue = $concurso->idConcurso->CurrentValue;
			$concurso->idConcurso->ViewCustomAttributes = "";

			// nombre
			$concurso->nombre->ViewValue = $concurso->nombre->CurrentValue;
			$concurso->nombre->ViewCustomAttributes = "";

			// fechaInicio
			$concurso->fechaInicio->ViewValue = $concurso->fechaInicio->CurrentValue;
			$concurso->fechaInicio->ViewValue = ew_FormatDateTime($concurso->fechaInicio->ViewValue, 9);
			$concurso->fechaInicio->ViewCustomAttributes = "";

			// fechaFin
			$concurso->fechaFin->ViewValue = $concurso->fechaFin->CurrentValue;
			$concurso->fechaFin->ViewValue = ew_FormatDateTime($concurso->fechaFin->ViewValue, 9);
			$concurso->fechaFin->ViewCustomAttributes = "";

			// idConcurso
			$concurso->idConcurso->LinkCustomAttributes = "";
			$concurso->idConcurso->HrefValue = "";
			$concurso->idConcurso->TooltipValue = "";

			// nombre
			$concurso->nombre->LinkCustomAttributes = "";
			$concurso->nombre->HrefValue = "";
			$concurso->nombre->TooltipValue = "";

			// fechaInicio
			$concurso->fechaInicio->LinkCustomAttributes = "";
			$concurso->fechaInicio->HrefValue = "";
			$concurso->fechaInicio->TooltipValue = "";

			// fechaFin
			$concurso->fechaFin->LinkCustomAttributes = "";
			$concurso->fechaFin->HrefValue = "";
			$concurso->fechaFin->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($concurso->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $concurso;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_concurso\" id=\"emf_concurso\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_concurso',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fconcursolist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($concurso->Export <> "" ||
			$concurso->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $concurso;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $concurso->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($concurso->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($concurso->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($concurso, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($concurso->Export == "xml") {
			$concurso->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$concurso->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($concurso->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($concurso->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($concurso->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($concurso->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($concurso->ExportReturnUrl());
		} elseif ($concurso->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
