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
$concurso_opcion_view = new cconcurso_opcion_view();
$Page =& $concurso_opcion_view;

// Page init
$concurso_opcion_view->Page_Init();

// Page main
$concurso_opcion_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($concurso_opcion->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_opcion_view = new ew_Page("concurso_opcion_view");

// page properties
concurso_opcion_view.PageID = "view"; // page ID
concurso_opcion_view.FormID = "fconcurso_opcionview"; // form ID
var EW_PAGE_ID = concurso_opcion_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
concurso_opcion_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_opcion_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_opcion_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso_opcion->TableCaption() ?>
&nbsp;&nbsp;<?php $concurso_opcion_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($concurso_opcion->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $concurso_opcion_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $concurso_opcion_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $concurso_opcion_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $concurso_opcion_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $concurso_opcion_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $concurso_opcion_view->ShowPageHeader(); ?>
<?php
$concurso_opcion_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($concurso_opcion->idConcursoOpcion->Visible) { // idConcursoOpcion ?>
	<tr id="r_idConcursoOpcion"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->idConcursoOpcion->FldCaption() ?></td>
		<td<?php echo $concurso_opcion->idConcursoOpcion->CellAttributes() ?>>
<div<?php echo $concurso_opcion->idConcursoOpcion->ViewAttributes() ?>><?php echo $concurso_opcion->idConcursoOpcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($concurso_opcion->concursoId->Visible) { // concursoId ?>
	<tr id="r_concursoId"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->concursoId->FldCaption() ?></td>
		<td<?php echo $concurso_opcion->concursoId->CellAttributes() ?>>
<div<?php echo $concurso_opcion->concursoId->ViewAttributes() ?>><?php echo $concurso_opcion->concursoId->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($concurso_opcion->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->imagen->FldCaption() ?></td>
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
	</tr>
<?php } ?>
<?php if ($concurso_opcion->votos->Visible) { // votos ?>
	<tr id="r_votos"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->votos->FldCaption() ?></td>
		<td<?php echo $concurso_opcion->votos->CellAttributes() ?>>
<div<?php echo $concurso_opcion->votos->ViewAttributes() ?>><?php echo $concurso_opcion->votos->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$concurso_opcion_view->ShowPageFooter();
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
$concurso_opcion_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_opcion_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'concurso_opcion';

	// Page object name
	var $PageObjName = 'concurso_opcion_view';

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
	function cconcurso_opcion_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (concurso_opcion)
		if (!isset($GLOBALS["concurso_opcion"])) {
			$GLOBALS["concurso_opcion"] = new cconcurso_opcion();
			$GLOBALS["Table"] =& $GLOBALS["concurso_opcion"];
		}
		$KeyUrl = "";
		if (@$_GET["idConcursoOpcion"] <> "") {
			$this->RecKey["idConcursoOpcion"] = $_GET["idConcursoOpcion"];
			$KeyUrl .= "&idConcursoOpcion=" . urlencode($this->RecKey["idConcursoOpcion"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'concurso_opcion', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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
		if (@$_GET["idConcursoOpcion"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["idConcursoOpcion"]);
		}
		if ($concurso_opcion->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($concurso_opcion->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $concurso_opcion;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idConcursoOpcion"] <> "") {
				$concurso_opcion->idConcursoOpcion->setQueryStringValue($_GET["idConcursoOpcion"]);
				$this->RecKey["idConcursoOpcion"] = $concurso_opcion->idConcursoOpcion->QueryStringValue;
			} else {
				$sReturnUrl = "concurso_opcionlist.php"; // Return to list
			}

			// Get action
			$concurso_opcion->CurrentAction = "I"; // Display form
			switch ($concurso_opcion->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "concurso_opcionlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($concurso_opcion->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				if ($concurso_opcion->Export == "email" && $concurso_opcion->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$concurso_opcion->setExportReturnUrl($concurso_opcion->ViewUrl()); // Add key
				$this->ExportData();
				if ($concurso_opcion->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "concurso_opcionlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$concurso_opcion->RowType = EW_ROWTYPE_VIEW;
		$concurso_opcion->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $concurso_opcion;

		// Initialize URLs
		$this->AddUrl = $concurso_opcion->AddUrl();
		$this->EditUrl = $concurso_opcion->EditUrl();
		$this->CopyUrl = $concurso_opcion->CopyUrl();
		$this->DeleteUrl = $concurso_opcion->DeleteUrl();
		$this->ListUrl = $concurso_opcion->ListUrl();

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
		$item->Body = "<a name=\"emf_concurso_opcion\" id=\"emf_concurso_opcion\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_concurso_opcion',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($concurso_opcion->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $concurso_opcion;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $concurso_opcion->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs < 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($concurso_opcion->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($concurso_opcion, "v");
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
			$concurso_opcion->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$concurso_opcion->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
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
}
?>
