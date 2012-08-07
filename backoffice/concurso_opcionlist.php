<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "concurso_opcioninfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$concurso_opcion_list = new cconcurso_opcion_list();
$Page =& $concurso_opcion_list;

// Page init
$concurso_opcion_list->Page_Init();

// Page main
$concurso_opcion_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($concurso_opcion->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_opcion_list = new ew_Page("concurso_opcion_list");

// page properties
concurso_opcion_list.PageID = "list"; // page ID
concurso_opcion_list.FormID = "fconcurso_opcionlist"; // form ID
var EW_PAGE_ID = concurso_opcion_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
concurso_opcion_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_opcion_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_opcion_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($concurso_opcion->Export == "") || (EW_EXPORT_MASTER_RECORD && $concurso_opcion->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$concurso_opcion_list->TotalRecs = $concurso_opcion->SelectRecordCount();
	} else {
		if ($concurso_opcion_list->Recordset = $concurso_opcion_list->LoadRecordset())
			$concurso_opcion_list->TotalRecs = $concurso_opcion_list->Recordset->RecordCount();
	}
	$concurso_opcion_list->StartRec = 1;
	if ($concurso_opcion_list->DisplayRecs <= 0 || ($concurso_opcion->Export <> "" && $concurso_opcion->ExportAll)) // Display all records
		$concurso_opcion_list->DisplayRecs = $concurso_opcion_list->TotalRecs;
	if (!($concurso_opcion->Export <> "" && $concurso_opcion->ExportAll))
		$concurso_opcion_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$concurso_opcion_list->Recordset = $concurso_opcion_list->LoadRecordset($concurso_opcion_list->StartRec-1, $concurso_opcion_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso_opcion->TableCaption() ?>
&nbsp;&nbsp;<?php $concurso_opcion_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($concurso_opcion->Export == "" && $concurso_opcion->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(concurso_opcion_list);" style="text-decoration: none;"><img id="concurso_opcion_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="concurso_opcion_list_SearchPanel">
<form name="fconcurso_opcionlistsrch" id="fconcurso_opcionlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="concurso_opcion">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($concurso_opcion->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $concurso_opcion_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($concurso_opcion->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($concurso_opcion->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($concurso_opcion->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $concurso_opcion_list->ShowPageHeader(); ?>
<?php
$concurso_opcion_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fconcurso_opcionlist" id="fconcurso_opcionlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="concurso_opcion">
<div id="gmp_concurso_opcion" class="ewGridMiddlePanel">
<?php if ($concurso_opcion_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $concurso_opcion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$concurso_opcion_list->RenderListOptions();

// Render list options (header, left)
$concurso_opcion_list->ListOptions->Render("header", "left");
?>
<?php if ($concurso_opcion->idConcursoOpcion->Visible) { // idConcursoOpcion ?>
	<?php if ($concurso_opcion->SortUrl($concurso_opcion->idConcursoOpcion) == "") { ?>
		<td><?php echo $concurso_opcion->idConcursoOpcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso_opcion->SortUrl($concurso_opcion->idConcursoOpcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso_opcion->idConcursoOpcion->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso_opcion->idConcursoOpcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso_opcion->idConcursoOpcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso_opcion->concursoId->Visible) { // concursoId ?>
	<?php if ($concurso_opcion->SortUrl($concurso_opcion->concursoId) == "") { ?>
		<td><?php echo $concurso_opcion->concursoId->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso_opcion->SortUrl($concurso_opcion->concursoId) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso_opcion->concursoId->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso_opcion->concursoId->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso_opcion->concursoId->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso_opcion->imagen->Visible) { // imagen ?>
	<?php if ($concurso_opcion->SortUrl($concurso_opcion->imagen) == "") { ?>
		<td><?php echo $concurso_opcion->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso_opcion->SortUrl($concurso_opcion->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso_opcion->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso_opcion->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso_opcion->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($concurso_opcion->votos->Visible) { // votos ?>
	<?php if ($concurso_opcion->SortUrl($concurso_opcion->votos) == "") { ?>
		<td><?php echo $concurso_opcion->votos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $concurso_opcion->SortUrl($concurso_opcion->votos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $concurso_opcion->votos->FldCaption() ?></td><td style="width: 10px;"><?php if ($concurso_opcion->votos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($concurso_opcion->votos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$concurso_opcion_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($concurso_opcion->ExportAll && $concurso_opcion->Export <> "") {
	$concurso_opcion_list->StopRec = $concurso_opcion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($concurso_opcion_list->TotalRecs > $concurso_opcion_list->StartRec + $concurso_opcion_list->DisplayRecs - 1)
		$concurso_opcion_list->StopRec = $concurso_opcion_list->StartRec + $concurso_opcion_list->DisplayRecs - 1;
	else
		$concurso_opcion_list->StopRec = $concurso_opcion_list->TotalRecs;
}
$concurso_opcion_list->RecCnt = $concurso_opcion_list->StartRec - 1;
if ($concurso_opcion_list->Recordset && !$concurso_opcion_list->Recordset->EOF) {
	$concurso_opcion_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $concurso_opcion_list->StartRec > 1)
		$concurso_opcion_list->Recordset->Move($concurso_opcion_list->StartRec - 1);
} elseif (!$concurso_opcion->AllowAddDeleteRow && $concurso_opcion_list->StopRec == 0) {
	$concurso_opcion_list->StopRec = $concurso_opcion->GridAddRowCount;
}

// Initialize aggregate
$concurso_opcion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$concurso_opcion->ResetAttrs();
$concurso_opcion_list->RenderRow();
$concurso_opcion_list->RowCnt = 0;
while ($concurso_opcion_list->RecCnt < $concurso_opcion_list->StopRec) {
	$concurso_opcion_list->RecCnt++;
	if (intval($concurso_opcion_list->RecCnt) >= intval($concurso_opcion_list->StartRec)) {
		$concurso_opcion_list->RowCnt++;

		// Set up key count
		$concurso_opcion_list->KeyCount = $concurso_opcion_list->RowIndex;

		// Init row class and style
		$concurso_opcion->ResetAttrs();
		$concurso_opcion->CssClass = "";
		if ($concurso_opcion->CurrentAction == "gridadd") {
		} else {
			$concurso_opcion_list->LoadRowValues($concurso_opcion_list->Recordset); // Load row values
		}
		$concurso_opcion->RowType = EW_ROWTYPE_VIEW; // Render view
		$concurso_opcion->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$concurso_opcion_list->RenderRow();

		// Render list options
		$concurso_opcion_list->RenderListOptions();
?>
	<tr<?php echo $concurso_opcion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$concurso_opcion_list->ListOptions->Render("body", "left");
?>
	<?php if ($concurso_opcion->idConcursoOpcion->Visible) { // idConcursoOpcion ?>
		<td<?php echo $concurso_opcion->idConcursoOpcion->CellAttributes() ?>>
<div<?php echo $concurso_opcion->idConcursoOpcion->ViewAttributes() ?>><?php echo $concurso_opcion->idConcursoOpcion->ListViewValue() ?></div>
<a name="<?php echo $concurso_opcion_list->PageObjName . "_row_" . $concurso_opcion_list->RowCnt ?>" id="<?php echo $concurso_opcion_list->PageObjName . "_row_" . $concurso_opcion_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($concurso_opcion->concursoId->Visible) { // concursoId ?>
		<td<?php echo $concurso_opcion->concursoId->CellAttributes() ?>>
<div<?php echo $concurso_opcion->concursoId->ViewAttributes() ?>><?php echo $concurso_opcion->concursoId->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($concurso_opcion->imagen->Visible) { // imagen ?>
		<td<?php echo $concurso_opcion->imagen->CellAttributes() ?>>
<?php if ($concurso_opcion->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($concurso_opcion->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $concurso_opcion->imagen->UploadPath) . $concurso_opcion->imagen->Upload->DbValue ?>" border=0<?php echo $concurso_opcion->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($concurso_opcion->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($concurso_opcion->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $concurso_opcion->imagen->UploadPath) . $concurso_opcion->imagen->Upload->DbValue ?>" border=0<?php echo $concurso_opcion->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($concurso_opcion->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($concurso_opcion->votos->Visible) { // votos ?>
		<td<?php echo $concurso_opcion->votos->CellAttributes() ?>>
<div<?php echo $concurso_opcion->votos->ViewAttributes() ?>><?php echo $concurso_opcion->votos->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$concurso_opcion_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($concurso_opcion->CurrentAction <> "gridadd")
		$concurso_opcion_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($concurso_opcion_list->Recordset)
	$concurso_opcion_list->Recordset->Close();
?>
<?php if ($concurso_opcion->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($concurso_opcion->CurrentAction <> "gridadd" && $concurso_opcion->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($concurso_opcion_list->Pager)) $concurso_opcion_list->Pager = new cPrevNextPager($concurso_opcion_list->StartRec, $concurso_opcion_list->DisplayRecs, $concurso_opcion_list->TotalRecs) ?>
<?php if ($concurso_opcion_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($concurso_opcion_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_opcion_list->PageUrl() ?>start=<?php echo $concurso_opcion_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($concurso_opcion_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_opcion_list->PageUrl() ?>start=<?php echo $concurso_opcion_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $concurso_opcion_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($concurso_opcion_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_opcion_list->PageUrl() ?>start=<?php echo $concurso_opcion_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($concurso_opcion_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $concurso_opcion_list->PageUrl() ?>start=<?php echo $concurso_opcion_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $concurso_opcion_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $concurso_opcion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $concurso_opcion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $concurso_opcion_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($concurso_opcion_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $concurso_opcion_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($concurso_opcion->Export == "" && $concurso_opcion->CurrentAction == "") { ?>
<?php } ?>
<?php
$concurso_opcion_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($concurso_opcion->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$concurso_opcion_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_opcion_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'concurso_opcion';

	// Page object name
	var $PageObjName = 'concurso_opcion_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $concurso_opcion;
		if ($concurso_opcion->UseTokenInUrl) $PageUrl .= "t=" . $concurso_opcion->TableVar . "&"; // Add page token
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
		global $objForm, $concurso_opcion;
		if ($concurso_opcion->UseTokenInUrl) {
			if ($objForm)
				return ($concurso_opcion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($concurso_opcion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconcurso_opcion_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (concurso_opcion)
		if (!isset($GLOBALS["concurso_opcion"])) {
			$GLOBALS["concurso_opcion"] = new cconcurso_opcion();
			$GLOBALS["Table"] =& $GLOBALS["concurso_opcion"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "concurso_opcionadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "concurso_opciondelete.php";
		$this->MultiUpdateUrl = "concurso_opcionupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'concurso_opcion', TRUE);

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
		global $concurso_opcion;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$concurso_opcion->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$concurso_opcion->Export = $_POST["exporttype"];
		} else {
			$concurso_opcion->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $concurso_opcion->Export; // Get export parameter, used in header
		$gsExportFile = $concurso_opcion->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($concurso_opcion->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($concurso_opcion->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$concurso_opcion->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $concurso_opcion;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($concurso_opcion->Export <> "" ||
				$concurso_opcion->CurrentAction == "gridadd" ||
				$concurso_opcion->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$concurso_opcion->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($concurso_opcion->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $concurso_opcion->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$concurso_opcion->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$concurso_opcion->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$concurso_opcion->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $concurso_opcion->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$concurso_opcion->setSessionWhere($sFilter);
		$concurso_opcion->CurrentFilter = "";

		// Export data only
		if (in_array($concurso_opcion->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($concurso_opcion->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $concurso_opcion;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $concurso_opcion->imagen, $Keyword);
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
		global $Security, $concurso_opcion;
		$sSearchStr = "";
		$sSearchKeyword = $concurso_opcion->BasicSearchKeyword;
		$sSearchType = $concurso_opcion->BasicSearchType;
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
			$concurso_opcion->setSessionBasicSearchKeyword($sSearchKeyword);
			$concurso_opcion->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $concurso_opcion;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$concurso_opcion->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $concurso_opcion;
		$concurso_opcion->setSessionBasicSearchKeyword("");
		$concurso_opcion->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $concurso_opcion;
		$bRestore = TRUE;
		if ($concurso_opcion->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$concurso_opcion->BasicSearchKeyword = $concurso_opcion->getSessionBasicSearchKeyword();
			$concurso_opcion->BasicSearchType = $concurso_opcion->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $concurso_opcion;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$concurso_opcion->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$concurso_opcion->CurrentOrderType = @$_GET["ordertype"];
			$concurso_opcion->UpdateSort($concurso_opcion->idConcursoOpcion); // idConcursoOpcion
			$concurso_opcion->UpdateSort($concurso_opcion->concursoId); // concursoId
			$concurso_opcion->UpdateSort($concurso_opcion->imagen); // imagen
			$concurso_opcion->UpdateSort($concurso_opcion->votos); // votos
			$concurso_opcion->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $concurso_opcion;
		$sOrderBy = $concurso_opcion->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($concurso_opcion->SqlOrderBy() <> "") {
				$sOrderBy = $concurso_opcion->SqlOrderBy();
				$concurso_opcion->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $concurso_opcion;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$concurso_opcion->setSessionOrderBy($sOrderBy);
				$concurso_opcion->idConcursoOpcion->setSort("");
				$concurso_opcion->concursoId->setSort("");
				$concurso_opcion->imagen->setSort("");
				$concurso_opcion->votos->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$concurso_opcion->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $concurso_opcion;

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
		global $Security, $Language, $concurso_opcion, $objForm;
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
		global $Security, $Language, $concurso_opcion;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $concurso_opcion;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$concurso_opcion->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$concurso_opcion->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $concurso_opcion->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$concurso_opcion->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$concurso_opcion->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$concurso_opcion->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $concurso_opcion;
		$concurso_opcion->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$concurso_opcion->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $concurso_opcion;

		// Call Recordset Selecting event
		$concurso_opcion->Recordset_Selecting($concurso_opcion->CurrentFilter);

		// Load List page SQL
		$sSql = $concurso_opcion->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$concurso_opcion->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $concurso_opcion;
		$sFilter = $concurso_opcion->KeyFilter();

		// Call Row Selecting event
		$concurso_opcion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$concurso_opcion->CurrentFilter = $sFilter;
		$sSql = $concurso_opcion->SQL();
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
		global $conn, $concurso_opcion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$concurso_opcion->Row_Selected($row);
		$concurso_opcion->idConcursoOpcion->setDbValue($rs->fields('idConcursoOpcion'));
		$concurso_opcion->concursoId->setDbValue($rs->fields('concursoId'));
		$concurso_opcion->imagen->Upload->DbValue = $rs->fields('imagen');
		$concurso_opcion->votos->setDbValue($rs->fields('votos'));
	}

	// Load old record
	function LoadOldRecord() {
		global $concurso_opcion;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($concurso_opcion->getKey("idConcursoOpcion")) <> "")
			$concurso_opcion->idConcursoOpcion->CurrentValue = $concurso_opcion->getKey("idConcursoOpcion"); // idConcursoOpcion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$concurso_opcion->CurrentFilter = $concurso_opcion->KeyFilter();
			$sSql = $concurso_opcion->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $concurso_opcion;

		// Initialize URLs
		$this->ViewUrl = $concurso_opcion->ViewUrl();
		$this->EditUrl = $concurso_opcion->EditUrl();
		$this->InlineEditUrl = $concurso_opcion->InlineEditUrl();
		$this->CopyUrl = $concurso_opcion->CopyUrl();
		$this->InlineCopyUrl = $concurso_opcion->InlineCopyUrl();
		$this->DeleteUrl = $concurso_opcion->DeleteUrl();

		// Call Row_Rendering event
		$concurso_opcion->Row_Rendering();

		// Common render codes for all row types
		// idConcursoOpcion
		// concursoId
		// imagen
		// votos

		if ($concurso_opcion->RowType == EW_ROWTYPE_VIEW) { // View row

			// idConcursoOpcion
			$concurso_opcion->idConcursoOpcion->ViewValue = $concurso_opcion->idConcursoOpcion->CurrentValue;
			$concurso_opcion->idConcursoOpcion->ViewCustomAttributes = "";

			// concursoId
			if (strval($concurso_opcion->concursoId->CurrentValue) <> "") {
				$sFilterWrk = "`idConcurso` = " . ew_AdjustSql($concurso_opcion->concursoId->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `concurso`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$concurso_opcion->concursoId->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$concurso_opcion->concursoId->ViewValue = $concurso_opcion->concursoId->CurrentValue;
				}
			} else {
				$concurso_opcion->concursoId->ViewValue = NULL;
			}
			$concurso_opcion->concursoId->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($concurso_opcion->imagen->Upload->DbValue)) {
				$concurso_opcion->imagen->ViewValue = $concurso_opcion->imagen->Upload->DbValue;
				$concurso_opcion->imagen->ImageWidth = 200;
				$concurso_opcion->imagen->ImageHeight = 200;
				$concurso_opcion->imagen->ImageAlt = $concurso_opcion->imagen->FldAlt();
			} else {
				$concurso_opcion->imagen->ViewValue = "";
			}
			$concurso_opcion->imagen->ViewCustomAttributes = "";

			// votos
			$concurso_opcion->votos->ViewValue = $concurso_opcion->votos->CurrentValue;
			$concurso_opcion->votos->ViewCustomAttributes = "";

			// idConcursoOpcion
			$concurso_opcion->idConcursoOpcion->LinkCustomAttributes = "";
			$concurso_opcion->idConcursoOpcion->HrefValue = "";
			$concurso_opcion->idConcursoOpcion->TooltipValue = "";

			// concursoId
			$concurso_opcion->concursoId->LinkCustomAttributes = "";
			$concurso_opcion->concursoId->HrefValue = "";
			$concurso_opcion->concursoId->TooltipValue = "";

			// imagen
			$concurso_opcion->imagen->LinkCustomAttributes = "";
			$concurso_opcion->imagen->HrefValue = "";
			$concurso_opcion->imagen->TooltipValue = "";

			// votos
			$concurso_opcion->votos->LinkCustomAttributes = "";
			$concurso_opcion->votos->HrefValue = "";
			$concurso_opcion->votos->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($concurso_opcion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso_opcion->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $concurso_opcion;

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
		$item->Body = "<a name=\"emf_concurso_opcion\" id=\"emf_concurso_opcion\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_concurso_opcion',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fconcurso_opcionlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($concurso_opcion->Export <> "" ||
			$concurso_opcion->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $concurso_opcion;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $concurso_opcion->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($concurso_opcion->ExportAll) {
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
		if ($concurso_opcion->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($concurso_opcion, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($concurso_opcion->Export == "xml") {
			$concurso_opcion->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$concurso_opcion->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($concurso_opcion->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($concurso_opcion->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($concurso_opcion->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($concurso_opcion->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($concurso_opcion->ExportReturnUrl());
		} elseif ($concurso_opcion->Export == "pdf") {
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
