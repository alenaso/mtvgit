<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_view = new cusuarios_view();
$Page =& $usuarios_view;

// Page init
$usuarios_view->Page_Init();

// Page main
$usuarios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_view = new ew_Page("usuarios_view");

// page properties
usuarios_view.PageID = "view"; // page ID
usuarios_view.FormID = "fusuariosview"; // form ID
var EW_PAGE_ID = usuarios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?>
&nbsp;&nbsp;<?php $usuarios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuarios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuarios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuarios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $usuarios_view->ShowPageHeader(); ?>
<?php
$usuarios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->idUsuario->Visible) { // idUsuario ?>
	<tr id="r_idUsuario"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->idUsuario->FldCaption() ?></td>
		<td<?php echo $usuarios->idUsuario->CellAttributes() ?>>
<div<?php echo $usuarios->idUsuario->ViewAttributes() ?>><?php echo $usuarios->idUsuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nombre->FldCaption() ?></td>
		<td<?php echo $usuarios->nombre->CellAttributes() ?>>
<div<?php echo $usuarios->nombre->ViewAttributes() ?>><?php echo $usuarios->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->apellido->Visible) { // apellido ?>
	<tr id="r_apellido"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->apellido->FldCaption() ?></td>
		<td<?php echo $usuarios->apellido->CellAttributes() ?>>
<div<?php echo $usuarios->apellido->ViewAttributes() ?>><?php echo $usuarios->apellido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nombreCompleto->Visible) { // nombreCompleto ?>
	<tr id="r_nombreCompleto"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nombreCompleto->FldCaption() ?></td>
		<td<?php echo $usuarios->nombreCompleto->CellAttributes() ?>>
<div<?php echo $usuarios->nombreCompleto->ViewAttributes() ?>><?php echo $usuarios->nombreCompleto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nacimiento->Visible) { // nacimiento ?>
	<tr id="r_nacimiento"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nacimiento->FldCaption() ?></td>
		<td<?php echo $usuarios->nacimiento->CellAttributes() ?>>
<div<?php echo $usuarios->nacimiento->ViewAttributes() ?>><?php echo $usuarios->nacimiento->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->lugar->Visible) { // lugar ?>
	<tr id="r_lugar"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->lugar->FldCaption() ?></td>
		<td<?php echo $usuarios->lugar->CellAttributes() ?>>
<div<?php echo $usuarios->lugar->ViewAttributes() ?>><?php echo $usuarios->lugar->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->facebookId->Visible) { // facebookId ?>
	<tr id="r_facebookId"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->facebookId->FldCaption() ?></td>
		<td<?php echo $usuarios->facebookId->CellAttributes() ?>>
<div<?php echo $usuarios->facebookId->ViewAttributes() ?>><?php echo $usuarios->facebookId->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->imagen->FldCaption() ?></td>
		<td<?php echo $usuarios->imagen->CellAttributes() ?>>
<?php if (!ew_EmptyStr($usuarios->imagen->ViewValue)) { ?><img src="<?php echo $usuarios->imagen->ViewValue ?>" border="0"<?php echo $usuarios->imagen->ViewAttributes() ?>><?php } ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->sexo->Visible) { // sexo ?>
	<tr id="r_sexo"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->sexo->FldCaption() ?></td>
		<td<?php echo $usuarios->sexo->CellAttributes() ?>>
<div<?php echo $usuarios->sexo->ViewAttributes() ?>><?php echo $usuarios->sexo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->zemail->FldCaption() ?></td>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>>
<div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->fechaAlta->Visible) { // fechaAlta ?>
	<tr id="r_fechaAlta"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->fechaAlta->FldCaption() ?></td>
		<td<?php echo $usuarios->fechaAlta->CellAttributes() ?>>
<div<?php echo $usuarios->fechaAlta->ViewAttributes() ?>><?php echo $usuarios->fechaAlta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->IP->Visible) { // IP ?>
	<tr id="r_IP"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->IP->FldCaption() ?></td>
		<td<?php echo $usuarios->IP->CellAttributes() ?>>
<div<?php echo $usuarios->IP->ViewAttributes() ?>><?php echo $usuarios->IP->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuarios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuarios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}
		$KeyUrl = "";
		if (@$_GET["idUsuario"] <> "") {
			$this->RecKey["idUsuario"] = $_GET["idUsuario"];
			$KeyUrl .= "&idUsuario=" . urlencode($this->RecKey["idUsuario"]);
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
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		global $usuarios;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$usuarios->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$usuarios->Export = $_POST["exporttype"];
		} else {
			$usuarios->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $usuarios->Export; // Get export parameter, used in header
		$gsExportFile = $usuarios->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["idUsuario"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["idUsuario"]);
		}
		if ($usuarios->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($usuarios->Export == "csv") {
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
		global $Language, $usuarios;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idUsuario"] <> "") {
				$usuarios->idUsuario->setQueryStringValue($_GET["idUsuario"]);
				$this->RecKey["idUsuario"] = $usuarios->idUsuario->QueryStringValue;
			} else {
				$sReturnUrl = "usuarioslist.php"; // Return to list
			}

			// Get action
			$usuarios->CurrentAction = "I"; // Display form
			switch ($usuarios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuarioslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($usuarios->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				if ($usuarios->Export == "email" && $usuarios->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$usuarios->setExportReturnUrl($usuarios->ViewUrl()); // Add key
				$this->ExportData();
				if ($usuarios->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "usuarioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuarios->RowType = EW_ROWTYPE_VIEW;
		$usuarios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuarios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuarios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuarios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarios;

		// Call Recordset Selecting event
		$usuarios->Recordset_Selecting($usuarios->CurrentFilter);

		// Load List page SQL
		$sSql = $usuarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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
		global $conn, $usuarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarios->Row_Selected($row);
		$usuarios->idUsuario->setDbValue($rs->fields('idUsuario'));
		$usuarios->nombre->setDbValue($rs->fields('nombre'));
		$usuarios->apellido->setDbValue($rs->fields('apellido'));
		$usuarios->nombreCompleto->setDbValue($rs->fields('nombreCompleto'));
		$usuarios->nacimiento->setDbValue($rs->fields('nacimiento'));
		$usuarios->lugar->setDbValue($rs->fields('lugar'));
		$usuarios->facebookId->setDbValue($rs->fields('facebookId'));
		$usuarios->imagen->setDbValue($rs->fields('imagen'));
		$usuarios->sexo->setDbValue($rs->fields('sexo'));
		$usuarios->zemail->setDbValue($rs->fields('email'));
		$usuarios->fechaAlta->setDbValue($rs->fields('fechaAlta'));
		$usuarios->IP->setDbValue($rs->fields('IP'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
		$this->AddUrl = $usuarios->AddUrl();
		$this->EditUrl = $usuarios->EditUrl();
		$this->CopyUrl = $usuarios->CopyUrl();
		$this->DeleteUrl = $usuarios->DeleteUrl();
		$this->ListUrl = $usuarios->ListUrl();

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// idUsuario
		// nombre
		// apellido
		// nombreCompleto
		// nacimiento
		// lugar
		// facebookId
		// imagen
		// sexo
		// email
		// fechaAlta
		// IP

		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// idUsuario
			$usuarios->idUsuario->ViewValue = $usuarios->idUsuario->CurrentValue;
			$usuarios->idUsuario->ViewCustomAttributes = "";

			// nombre
			$usuarios->nombre->ViewValue = $usuarios->nombre->CurrentValue;
			$usuarios->nombre->ViewCustomAttributes = "";

			// apellido
			$usuarios->apellido->ViewValue = $usuarios->apellido->CurrentValue;
			$usuarios->apellido->ViewCustomAttributes = "";

			// nombreCompleto
			$usuarios->nombreCompleto->ViewValue = $usuarios->nombreCompleto->CurrentValue;
			$usuarios->nombreCompleto->ViewCustomAttributes = "";

			// nacimiento
			$usuarios->nacimiento->ViewValue = $usuarios->nacimiento->CurrentValue;
			$usuarios->nacimiento->ViewCustomAttributes = "";

			// lugar
			$usuarios->lugar->ViewValue = $usuarios->lugar->CurrentValue;
			$usuarios->lugar->ViewCustomAttributes = "";

			// facebookId
			$usuarios->facebookId->ViewValue = $usuarios->facebookId->CurrentValue;
			$usuarios->facebookId->ViewCustomAttributes = "";

			// imagen
			$usuarios->imagen->ViewValue = $usuarios->imagen->CurrentValue;
			$usuarios->imagen->ImageWidth = 70;
			$usuarios->imagen->ImageHeight = 70;
			$usuarios->imagen->ImageAlt = $usuarios->imagen->FldAlt();
			$usuarios->imagen->ViewCustomAttributes = "";

			// sexo
			$usuarios->sexo->ViewValue = $usuarios->sexo->CurrentValue;
			$usuarios->sexo->ViewCustomAttributes = "";

			// email
			$usuarios->zemail->ViewValue = $usuarios->zemail->CurrentValue;
			$usuarios->zemail->ViewCustomAttributes = "";

			// fechaAlta
			$usuarios->fechaAlta->ViewValue = $usuarios->fechaAlta->CurrentValue;
			$usuarios->fechaAlta->ViewValue = ew_FormatDateTime($usuarios->fechaAlta->ViewValue, 5);
			$usuarios->fechaAlta->ViewCustomAttributes = "";

			// IP
			$usuarios->IP->ViewValue = $usuarios->IP->CurrentValue;
			$usuarios->IP->ViewCustomAttributes = "";

			// idUsuario
			$usuarios->idUsuario->LinkCustomAttributes = "";
			$usuarios->idUsuario->HrefValue = "";
			$usuarios->idUsuario->TooltipValue = "";

			// nombre
			$usuarios->nombre->LinkCustomAttributes = "";
			$usuarios->nombre->HrefValue = "";
			$usuarios->nombre->TooltipValue = "";

			// apellido
			$usuarios->apellido->LinkCustomAttributes = "";
			$usuarios->apellido->HrefValue = "";
			$usuarios->apellido->TooltipValue = "";

			// nombreCompleto
			$usuarios->nombreCompleto->LinkCustomAttributes = "";
			$usuarios->nombreCompleto->HrefValue = "";
			$usuarios->nombreCompleto->TooltipValue = "";

			// nacimiento
			$usuarios->nacimiento->LinkCustomAttributes = "";
			$usuarios->nacimiento->HrefValue = "";
			$usuarios->nacimiento->TooltipValue = "";

			// lugar
			$usuarios->lugar->LinkCustomAttributes = "";
			$usuarios->lugar->HrefValue = "";
			$usuarios->lugar->TooltipValue = "";

			// facebookId
			$usuarios->facebookId->LinkCustomAttributes = "";
			$usuarios->facebookId->HrefValue = "";
			$usuarios->facebookId->TooltipValue = "";

			// imagen
			$usuarios->imagen->LinkCustomAttributes = "";
			$usuarios->imagen->HrefValue = "";
			$usuarios->imagen->TooltipValue = "";

			// sexo
			$usuarios->sexo->LinkCustomAttributes = "";
			$usuarios->sexo->HrefValue = "";
			$usuarios->sexo->TooltipValue = "";

			// email
			$usuarios->zemail->LinkCustomAttributes = "";
			$usuarios->zemail->HrefValue = "";
			$usuarios->zemail->TooltipValue = "";

			// fechaAlta
			$usuarios->fechaAlta->LinkCustomAttributes = "";
			$usuarios->fechaAlta->HrefValue = "";
			$usuarios->fechaAlta->TooltipValue = "";

			// IP
			$usuarios->IP->LinkCustomAttributes = "";
			$usuarios->IP->HrefValue = "";
			$usuarios->IP->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $usuarios;

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
		$item->Body = "<a name=\"emf_usuarios\" id=\"emf_usuarios\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_usuarios',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($usuarios->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $usuarios;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $usuarios->SelectRecordCount();
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
		if ($usuarios->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($usuarios, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($usuarios->Export == "xml") {
			$usuarios->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$usuarios->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($usuarios->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($usuarios->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($usuarios->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($usuarios->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($usuarios->ExportReturnUrl());
		} elseif ($usuarios->Export == "pdf") {
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
